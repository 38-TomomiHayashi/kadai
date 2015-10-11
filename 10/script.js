
$(function() {
	
	
	var myname = "はやし";	
	$('#name-button').click(function () {
		myname = escapeHTML($("#name").val());
		console.log(myname);
		if (myname != "") {
			document.location.href = "linelike.html";
		}
	})
	
	
	//1.ミルクココアインスタンスを作成
	var milkcocoa = new MilkCocoa("juiceifc52b27.mlkcca.com");
	//2."message"データストアを作成
	var ds = milkcocoa.dataStore("message");
	//3."message"データストアからメッセージを取ってくる
	ds.stream().sort("desc").next(function(err, datas) {
		datas.forEach(function(data) {
			renderMessage(data);
		});
	});
	//4."message"データストアのプッシュイベントを監視
	ds.on("push", function(e) {
		renderMessage(e);
	});
	var last_message = "dummy";
	function renderMessage(message) {
		var message_html = '<p class="post-text">' + escapeHTML(message.value.content) + '</p>';
		var date_html = '';
		var name_html = '';
		if(message.value.date) {
			date_html = '<p class="post-date">'+escapeHTML( new Date(message.value.date).toLocaleString())+'</p>';
		}
		if(message.value.name) {
			name_html = '<p class="post-name">'+escapeHTML(message.value.name)+'</p>';
		}

		// 自分の投稿ならメッセージを右側に表示する
		var name = escapeHTML($("#name").val());
		var align = 'align-left';
		if(message.value.name == myname) {
			console.log(myname);
			align = 'align-right';
		}

		//$("#"+last_message).before('<div id="'+message.id+'" class="post">'+message_html + name_html + date_html +'</div>');
		$("#"+last_message).before('<div id="'+message.id+'" class="post ' + align + '">'+message_html + name_html + date_html +'</div>');
		last_message = message.id;
	}
	function post() {
		//5."message"データストアにメッセージをプッシュする
		var content = escapeHTML($("#content").val());
		//var name = escapeHTML($("#name").val());
		if (content && content !== "") {
			ds.push({
				title: "タイトル",
				content: content,
				date: new Date().getTime(),
				name: myname
			}, function (e) {});
		}
		$("#content").val("");
	}
	$('#post').click(function () {
		post();
	})
	$('#content').keydown(function (e) {
		if (e.which == 13){
			post();
			return false;
		}
	});
});
//インジェクション対策
function escapeHTML(val) {
	return $('<div>').text(val).html();
};
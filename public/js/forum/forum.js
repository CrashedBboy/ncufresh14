/****Text for Error message panel to show****************************************/
var titleEmptyMsg = "文章標題";
var contentEmptyMsg = "文章內容";
var commentEmptyMsg = "留言內容";
var notLoginMsg = "您尚未登入會員哦！";
/****Variables to store the url**************************************************/
var newArticleUrl;
var perArticleUrl;
var getArticlesUrl;
/****Store current user's information*********************************************/
var loginStatus;
var userId;
var userName;
//To indentify which tab and page we are now on
var tabLocation = "new";
var pageLocation = 1;

var burl = '';
var initType = '';
var initPage ='';
var initTab ='#Test1';

$(function(){

	burl = getTransferData('burl');
	loginStatus = $("#data_section").attr("data-login");

	if(loginStatus == 1){
		userId = $("#data_section").attr("data-user-id");
		userName = $("#data_section").attr("data-user-name");
	}

	/***********************************************************/
	newArticleUrl = $("#newArticle").attr("direct");
	perArticleUrl = $("#perArticle").attr("direct");
	getArticlesUrl = $("#getArticles").attr("direct");
	/************************************************************/

	initType = $("#initType").attr("direct");
	initPage = $("#initPage").attr("direct");


	if(initType =="new"){
		$("#articleTab").parent().addClass("active");
		initTab = "#Test1";
	}else if(initType =="pop"){
		$("#articleTab").parent().addClass("active");
		initTab = "#Test1";
	}else if(initType =="department"){
		$("#departmentTab").parent().addClass("active");
		initTab = "#Test2";
	}else if(initType =="club"){
		$("#clubTab").parent().addClass("active");
		initTab = "#Test3";
	}
	$(initTab).css('display','block');
	getArticles(initType,initPage,initTab);

	$("#articleTab").click(function(e){

		e.preventDefault();

		tabLocation = "new";
		pageLocation = 1;

		$("#Test1 .articleContainer").remove();

		getArticles(tabLocation,pageLocation,"#Test1");
		
	
		$("#Test2 .articleContainer").each(function(){
			$(this).remove();
		});
		$("#Test3 .articleContainer").each(function(){
			$(this).remove();
		});

		$(this).tab('show');
	});

	$("#new").change(function(){
		tabLocation = "new";
		pageLocation = 1;
		$("#Test1 .articleContainer").remove();
		getArticles(tabLocation,pageLocation,"#Test1");
	});

	$("#pop").change(function(){
		tabLocation = "pop";
		pageLocation = 1;
		$("#Test1 .articleContainer").remove();
		getArticles(tabLocation,pageLocation,"#Test1");
	});


	$("#clubTab").click(function(e){
		if(tabLocation != "club"){

			tabLocation = "club";
			pageLocation = 1;

			e.preventDefault();
			$(this).tab('show');
			
			$("#Test2 .articleContainer").each(function(){
				$(this).remove();
			});
			getArticles(tabLocation,pageLocation,"#Test3");
		}
	});

	$("#departmentTab").click(function(e){
		if(tabLocation != "department"){
			tabLocation = "department";
			pageLocation = 1;
			e.preventDefault();
			$(this).tab('show');
			$("#Test3 .articleContainer").each(function(){
				$(this).remove();
			});
			getArticles(tabLocation,pageLocation,"#Test2");
		}
	});

	$(document).on("click","#previousPage",function(e){
		e.preventDefault();
		pageLocation--;
		switch(tabLocation){
			case "new":
				$("#Test1 .articleContainer").remove();	
				getArticles(tabLocation,pageLocation,"#Test1");
				break;
			case "pop":
				$("#Test1 .articleContainer").remove();	
				getArticles(tabLocation,pageLocation,"#Test1");
				break;
			case "department":
				$("#Test2 .articleContainer").each(function(){
					$(this).remove();
				});
				getArticles(tabLocation,pageLocation,"#Test2");
				break;
			case "club":
				$("#Test3 .articleContainer").each(function(){
					$(this).remove();
				});
				getArticles(tabLocation,pageLocation,"#Test3");
				break;
		}
	});
	
	$(document).on("click","#nextPage",function(e){
		e.preventDefault();
		pageLocation++;
		switch(tabLocation){
			case "new":
				$("#Test1 .articleContainer").remove();	
				getArticles(tabLocation,pageLocation,"#Test1");
				break;
			case "pop":
				$("#Test1 .articleContainer").remove();	
				getArticles(tabLocation,pageLocation,"#Test1");
				break;
			case "department":
				$("#Test2 .articleContainer").each(function(){
					$(this).remove();
				});
				getArticles(tabLocation,pageLocation,"#Test2");
				break;
			case "club":
				$("#Test3 .articleContainer").each(function(){
					$(this).remove();
				});
				getArticles(tabLocation,pageLocation,"#Test3");
				break;
		}
	});

	$("#createBtn").click(function(){
		if(loginStatus != 1){
			$("#errorMsgContent").text(notLoginMsg);
			$("#errorMsgDialog").modal('toggle');
		}
		if(loginStatus == 1){
			$('#myModal').modal('toggle');
		}
	});

	$("#submitArticle").click(function(){
		var title = $("#inputTitle").val();
		var content =$("#inputDetail").val();
		var type = $("#selectType").val();
		if(title == '' && content == ''){
			$("#errorMsgContent").text("請輸入"+titleEmptyMsg+" , "+contentEmptyMsg);
			$("#errorMsgDialog").modal('toggle');
		}else if(title =='' && content != ''){
			$("#errorMsgContent").text("請輸入"+titleEmptyMsg);
			$("#errorMsgDialog").modal('toggle');
		}else if(title !='' && content ==''){
			$("#errorMsgContent").text("請輸入"+contentEmptyMsg);
			$("#errorMsgDialog").modal('toggle');
		}else{
			$.ajax({
				type:"POST",
				url:newArticleUrl,
				data:{
					"title":title,
					"content":content,
					"article_type":type
				},
				success:function(data){

					if(data.washing == true){

						$("#errorMsgContent").text("您的發文時間間隔太短啦!");

						$("#errorMsgDialog").modal('toggle');

					}else{

						$("#inputTitle").val("");
						$("#inputAuthor_id").val("");
						$("#inputDetail").val("");
						$('#myModal').modal('toggle');
						var insertPlace;
						if(type == "P"){
							insertPlace = "#toolBar";
						}else if(type == "D"){
							insertPlace = "#Test2";
						}else if(type == "C"){
							insertPlace = "#Test3";
						}

						var dateTime = new Date(data.articleTime.date);
						if(isNaN(dateTime.getFullYear())){

							var currentTime = data.articleTime.date;
						}else{
							var currentTime = dateTime.getFullYear()
											+"-"+(dateTime.getMonth()+1)
											+"-"+dateTime.getDate()
											+" "+dateTime.getHours()
											+":"+dateTime.getMinutes()
											+":"+dateTime.getSeconds();
						}
						insertArticle(
							data.articleAuthor,
							data.authorId,
							currentTime,
							data.articleId,
							data.articleTitle,
							data.articleContent.replace(/\n/g,"<br>"),
							insertPlace
						);
					}	
				},
				error:function(){
					alert("Error");
				}
			},"json");

		}
	});

	//Scroll the page to Top while click
	$("#scrollTop").click(function(){
		$("body").animate({ scrollTop: 0 }, 'slow');
	});

});

function splitContent(articleContent){

	var contnetArray = articleContent.split("<br>");

	var subContent = "<div class='subContent'>"
						+contnetArray[0]+"<br>"
						+contnetArray[1]+"<br>"
						+contnetArray[2]+"<br>"
						+contnetArray[3]+"<br>"
						+contnetArray[4]+"<br>"
						+contnetArray[5]+"<br>"
						+contnetArray[6]+"<br>"
						+contnetArray[7]+"<br>"
						+"</div>";

	return subContent;
}

function countLines(str){
	return str.split("<br>").length;
}

function showArticles(authorName,authorId,createdAt,articleId,title,content,target,type,page){

	var multiContent = "";

	if(countLines(content) > 10){

		multiContent = splitContent(content) 
						+ "<div class='originContent'>"
							+content
						+"</div>\
						<span class='more'><a>觀看全文</a></span>";

	}else{

		multiContent = "<div class='subContent'>"+content+"</div>";
	}

	$(target).append("\
		<div class='articleContainer' id='"+articleId+"' >\
			<div class='postTimeContainer'>\
				<div class='articlePostTime'>\
					<span class='author'>"+authorName+"</span>發布於"+createdAt+"\
				</div>\
			</div>\
			<div class='panel panel-default articleBody'>\
				<div class='panel-heading'>\
					<a href='"+perArticleUrl+"/"+articleId+"/"+type+"/"+page+"'><h3 class='panel-title'>"+title+"</h3></a>\
				</div>\
				<div class='personalImageBox' >\
					<img class='personalImage' src='"+burl+"/person/"+authorId+"'>\
				</div>\
				<div class='panel-body content'>"+multiContent+"</div>\
				<div class='clear'></div>\
			</div>\
		</div>"
	);

	$(".more").click(function(e){
		e.preventDefault();
		$(this).parent().parent().find(".subContent").remove();
		$(this).parent().parent().find(".originContent").fadeIn("fast");
		$(this).remove();
	});
}

function insertArticle(authorName,authorId,currentTime,articleId,title,content,target){

	var multiContent = "";

	if(countLines(content) > 10){

		multiContent = splitContent(content) 
						+ "<div class='originContent'>"
							+content
						+"</div>\
						<span class='more'><a>觀看全文</a></span>";

	}else{

		multiContent = "<div class='subContent'>"+content+"</div>";
	}
	if(target =="#toolBar"){
		$(target).after("\
			<div class='articleContainer' id='"+articleId+"' >\
				<div class='postTimeContainer'>\
					<div class='articlePostTime'>\
						<span class='author'>"+authorName+"</span>發布於"+currentTime+"\
					</div>\
				</div>\
				<div class='panel panel-default articleBody'>\
					<div class='panel-heading forumTitleBox'>\
						<a href='"+perArticleUrl+"/"+articleId+"'><h3 class='panel-title'>"+title+"</h3></a>\
					</div>\
					<div class='personalImageBox' >\
						<img class='personalImage' src='"+burl+"/person/"+authorId+"'>\
					</div>\
					<div class='panel-body content'>"+multiContent+"</div>\
					<div class='clear'></div>\
				</div>\
			</div>"
		);
	}else{
		$(target).append("\
			<div class='articleContainer' id='"+articleId+"' >\
				<div class='postTimeContainer'>\
					<div class='articlePostTime'>\
						<span class='author'>"+authorName+"</span>發布於"+currentTime+"\
					</div>\
				</div>\
				<div class='panel panel-default articleBody'>\
					<div class='panel-heading forumTitleBox'>\
						<a href='"+perArticleUrl+"/"+articleId+"'><h3 class='panel-title'>"+title+"</h3></a>\
					</div>\
					<div class='personalImageBox' >\
						<img class='personalImage' src='"+burl+"/person/"+authorId+"'>\
					</div>\
					<div class='panel-body content'>"+multiContent+"</div>\
					<div class='clear'></div>\
				</div>\
			</div>"
		);
	}

	$(".more").click(function(e){
		e.preventDefault();
		$(this).parent().parent().find(".subContent").remove();
		$(this).parent().parent().find(".originContent").fadeIn("fast");
		$(this).remove();
	});
}

function getArticles(type,page,target){
    $.ajax({
		type:"POST",
		url:getArticlesUrl+"?page="+page,
		data:{
			'articleType' : type,
		},
		success:function(data){

			for(i=0;i<data['data'].length;i++){
				showArticles(
					data['data'][i]['user']['name'],
					data['data'][i]['author_id'],
					data['data'][i]['created_at'],
					data['data'][i]['id'],
					data['data'][i]['title'],
					data['data'][i]['content'].replace(/\n/g,"<br>"),
					target,
					type,
					page
				);
			}
			pageGenerate(pageLocation,data.last_page);

			if(type == "new" || type == "pop"){
				$("#Test1 .panel-heading").each(function(){
					$(this).addClass("forumTitleBox");
				});
			}else if( type == "department"){
				$("#Test2 .panel-heading").each(function(){
					$(this).addClass("departmentTitleBox");
				});
			}else if(type == "club"){
				$("#Test3 .panel-heading").each(function(){
					$(this).addClass("clubTitleBox");
				});
			}
			
		},
		error:function(){
			$.alertMessage('Getting Articles failed');
		}
	},"json");
}

function pageGenerate(current,last){
	var pager="";
	if(current == 1 && last != 1){

		pager = "<span id='currentPage'>第 1 頁</span>\
				<ul class='pager'>\
					<li><a id='nextPage'>Next</a></li>\
				</ul>\
				<span id='totalPage'>共 "+last+" 頁</span>\
				";

	}else if(current == 1 && last == 1){

		pager = "";

	}else if(current == last && last != 1){

		pager = "<span id='currentPage'>最後一頁</span>\
				<ul class='pager'>\
					<li><a id='previousPage'>Previous</a></li>\
				</ul>\
				<span id='totalPage'>共 "+last+" 頁</span>\
				";

	}else{

		pager = "<span id='currentPage'>第 "+current+" 頁</span>\
				<ul class='pager'>\
					<li><a id='previousPage'>Previous</a></li>\
					<li><a id='nextPage'>Next</a></li>\
				</ul>\
				<span id='totalPage'>共 "+last+" 頁</span>\
				";

	}
	$(".paginationBox").html(pager);
}


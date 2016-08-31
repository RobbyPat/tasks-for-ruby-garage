function addTitle() {
	var newtitle = $("#title").val();
	if (newtitle.length > 0) {
	$("#newtitle").append('<div id="main"><li><span>' + newtitle + '</span><button class="del"></button></li><form class="addtask"><input id="texttask" type="text" placeholder=" Start typing here to create a task..."/><button id="addbtn" class="btn btn-success" type="button">Add Task</button></form></div>');
	$("#title").val('');
	}
		else alert("You didn't enter the title");
}

function delTitle() {
	$(this).closest("#main").remove();
}

function addTask() {
	var newtask = $(this).prev("#texttask").val();
	$(this).closest("#main").append('<form id="task"><input type="checkbox" class="done" /><label id="stringtask">' + newtask + '</label><button type="button" class="deltask"></form>');
	$(this).prev("#texttask").val('');
}

function delTask() {
	$(this).closest("#task").remove();
}

function doneTask() {
	if ($(this).siblings("#stringtask").css('textDecoration') == ('line-through')) {
		$(this).siblings("#stringtask").css('textDecoration', 'none');	
	}   else {
		$(this).siblings("#stringtask").css('textDecoration', 'line-through');
	}
}

$(function() {
	$(document).on('click', '#add', addTitle);
	$(document).on('click', '.del', delTitle);
	$(document).on('click', '#addbtn', addTask);
	$(document).on('click', '.deltask', delTask);
	$(document).on('click', '.done', doneTask);
});


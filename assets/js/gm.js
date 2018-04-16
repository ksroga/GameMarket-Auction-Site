$(document).ready(function() {

	// POPOVER
	$(function () {
	  $('[data-toggle="popover"]').popover()
	});

	// CHARACTERS LEFT - TITLE
	$("#title").bind('input', function() {
		$("#charLeft").html(70-($("#title").val().length));
	});

	// CHARACTERS LEFT - DESC
	$("#desc").bind('input', function() {
		$("#charLeftdesc").html(2000-($("#desc").val().length));
	});

	$(document).on('change','#images' , function(){
		$("#preview").html("");
		for(var i = 0; i < this.files.length; i++) {
			$("#preview").html($("#preview").html() + "<div class='img'><img src=" + window.URL.createObjectURL(this.files[i]) + " alt=" + this.files[i].name + " onclick='select(this);' /></div>");
		}
		document.getElementById("selectedImg").value = this.files[0].name;
		$("#previewText").show();
	});


});

function select(id) {
	document.getElementById("selectedImg").value = id.alt;
	id.parentElement.style.border = "3px solid #ff0033";
	var elements = document.getElementsByClassName('img');
	for(var i = 0; i <= elements.length; i++) {
		if(elements[i] != id.parentElement)
			elements[i].style.border = "2px solid #ffc107";
	}

}

function goBack() {
    window.history.back();
}
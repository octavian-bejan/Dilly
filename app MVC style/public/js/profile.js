var lastSelectedImage = -1;
var posts;
function manageClickOnImage(idOfImage)
{
	if(lastSelectedImage != -1)
	{
		document.getElementById("picture_" + lastSelectedImage).style.borderColor = "black";
	}
	document.getElementById("picture_" + idOfImage).style.borderColor = "blue";
	lastSelectedImage = idOfImage;
	document.getElementById('buton_confirm').disabled=false;
};
function imageFromInstagram()
{
	document.getElementById("tipImagine").value = "1";
	document.getElementById("image").value = "";

	var i = lastSelectedImage;
	console
	document.getElementById("urlOfImageFromInstagram").value = posts[i].images.standard_resolution.url;
	$('#getInstagram').modal('hide');
};
function getInstagramPosts()
{
	var http = new XMLHttpRequest();
	http.open("POST", url, true);

	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			$('#getInstagram').modal('show');
			posts = JSON.parse(http.responseText).data;

			for(var i=0; i<posts.length; ++i)
			{
				(function (i)
				{
					var img = new Image();

					var container = document.getElementById("instagram_posts_container");
					img.src = posts[i].images.thumbnail.url;
					img.id = 'picture_' + i;
					img.addEventListener("click", function() { manageClickOnImage(i); }, false);
					var div = document.createElement('div');
					div.className = 'gallery';
					div.appendChild(img);
					var divContainer = document.createElement('div');
					divContainer.className = 'responsive';
					divContainer.appendChild(div);
					container.appendChild(divContainer);
				}(i));
			}
		}
	}
	http.send();
};
function waiting()
{
	setTimeout(function(){ getInstagramPosts(); }, 2000);
}
function load()
{
	document.getElementById("buton_instagram").onclick = function() {
		var instagram_authentication = window.open("https://www.instagram.com/oauth/authorize/?client_id=4a23ee6fe081429abd9a5f05a5504870&redirect_uri=http://localhost:4001/appMVC/public/services/newToken&response_type=code");
		instagram_authentication.onbeforeunload = waiting();
		return false;
	};
}
window.onload = load;
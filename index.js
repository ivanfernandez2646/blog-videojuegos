let bodyArticle = document.getElementsByClassName("p-post").item(0);
let titleArticle = document.getElementsByClassName("title-selected-post").item(0);
let editButton = document.getElementById("aEditArticle");
let deleteButton = document.getElementById("aDeleteArticle");
let saveButton = document.getElementById("aSaveChanges");
let reverseButton = document.getElementById("aReverseChanges");

editButton.addEventListener('click', activeContentEditableArticle);
reverseButton.addEventListener('click', deactivateContentEditableArticle);
saveButton.addEventListener('click', saveEditionOfArticle);

function activeContentEditableArticle(evt){
    titleArticle.contentEditable = true;
    bodyArticle.contentEditable = true;
    bodyArticle.focus();

    editButton.style.display = "none";
    deleteButton.style.display = "none";
    saveButton.style.display = "block";
    reverseButton.style.display = "block";
}

function deactivateContentEditableArticle(evt){
    titleArticle.contentEditable = false;
    bodyArticle.contentEditable = false;
    bodyArticle.focus();

    editButton.style.display = "block";
    deleteButton.style.display = "block";
    saveButton.style.display = "none";
    reverseButton.style.display = "none";
}

function saveEditionOfArticle(){
    let paramsFromPHPURL = (new URL(document.location)).searchParams;
    let idArticle = paramsFromPHPURL.get('article');
    let newUrl = './forms/modify-article.php?idArticle=' + idArticle + '&titleArticle=' + titleArticle.textContent + '&descriptionArticle=' + bodyArticle.textContent;
    window.location = encodeURI(newUrl);
}


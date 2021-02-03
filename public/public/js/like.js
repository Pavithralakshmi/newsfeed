$('.like').on('click',function(event){
event.preventDefault();
postid=event.target.parentNode.dataset['postid'];
var islike=event.targetpreviousElementSibling==null;
$.ajax({
    method : 'Post',
    url:urlLike,
    data:{isLike:isLike,postid:postid,_token:token}
})
.done(function(){
event.target.innerText = islike ? event.target.innerText == 'Like' ? 'You like it' : 'Like' : event.target.innerText == 'Dislike' ? 'You dont like it' : 'Dislike';
if(isLike){
    event.target.nextElementSibling.innerText='DisLike';
}else{
        event.target.nextElementSibling.innerText = 'Like';
}
});
});
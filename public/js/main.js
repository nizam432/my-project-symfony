const articles=document.getElementById('articles');
if(articles){

	articles.addEventListener('click', e =>{
		if(e.target.className==='btn btn-danger delete-article'){
			if(confirm('Are you want to delete?')){
				const id=e.target.getAttribute('data-id');
				fetch('delete/${id}',{
					Method:'DELETE'
				}).then(res=>window.location.reload());
				
			}
		}
	});
}

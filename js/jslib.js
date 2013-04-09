function addLoadEvent(func){var oldonload=window.onload;if(typeof window.onload!='function'){window.onload=func;}else{window.onload=function(){oldonload();func();}}}

function $(i){return document.getElementById(i)}
function $$(e,p){p=p||document;return p.getElementsByTagName(e)}
		
function isNull(anode){
anode = $(anode);	
return (anode==null || typeof anode==undefined);
}

	function clrnpt(id){
		document.getElementById(id).value = '';
		document.getElementById('_'+id).src = '';
		document.getElementById('__'+id).value = '';
	}

		function cl(i){
			var j = $('x'+i);
			if(j.style.display!='inline-block')
				j.style.display='inline-block';
			else j.style.display='none'
		}
		
		function sh(j){
			j = $(j);
			if(j.style.display!='block')
				j.style.display='block';
			else j.style.display='none'
		}

		function swap(x, i, j){
			var a = $(x + i);
			var b = $(x + j);
			var temp = a.value;
			a.value = b.value;
			b.value = temp;
			___changer();	
		}

		function swat(x, i, j){
			try{
			var a = $(x + i);
			var b = $(x + j);
			var temp = a.value;
			a.value = b.value;
			b.value = temp;		
			a = $('_'+x + i);
			b = $('_'+x + j);
			temp = a.src;
			a.src = b.src;
			b.src = temp;		
			a = $('__'+x + i);
			b = $('__'+x + j);
			temp = a.value;
			a.value = b.value;
			b.value = temp;
			}catch(e){/*file*/}
			___changer();	
		}



/////////	
	function p_over(el){
		$('one_prev').src=el.src;
		$('one_prev').style.display = "block";
	}
	function p_out(){
		$('one_prev').src='';
		$('one_prev').style.display = "none";
	}
	
	function lightbox(){
		var ar = $$('img');
		var l = ar.length, i=0;
		for(i; i<l; i++){
			if(ar[i].parentNode.tagName != 'a' && ar[i].id.charAt(0)=='_'){
				ar[i].onmouseover = function(){p_over(this)};
				ar[i].onmouseout = function(){p_out()};
			}
		}
	}
	


///////////
function toArray(arraylike) {
	var l = arraylike.length;
    var array= new Array(l);
    for (var i= 0, n= l; i<n; i++)
        array[i]= arraylike[i];
    return array;
}


//////////////
	function ___changer(){___changed = true}
	
	function inject(){
		___changed = false;

		var v1 = $$('input'), l = v1.length, i=0, v2=[];
		for(i; i<l; i++){
			if((/(text|checkbox|radio|file|password)/) . test(v1[i].type)){
				v2.push(v1[i]);
			}
		}
		
		var v3 = toArray($$('textarea')),  v4 = toArray($$('select'));

		var d=v2.concat(v3).concat(v4), l=d.length, i=0;
		for(i; i<l; i++){
			d[i].onclick = ___changer;
		}
		
		//TODO OLDSUBMIT
		$$('form')[0].onsubmit = function(){___changed = false; return true}
		
		window.onbeforeunload = function(){if(___changed) return ('Ќа этой странице сделаны изменени€. ≈сли вы покинете ее, изменени€ будут потер€ны!')}
	}
	

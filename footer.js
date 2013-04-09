var TINY={};function $(i){return document.getElementById(i)}function $$(e,p){p=p||document;return p.getElementsByTagName(e)}
ie  = navigator.userAgent.match(/msie/i);


cancelEvent = function(e){
	e = e ? e : window.event;
	if(e.stopPropagation)
	e.stopPropagation();
	if(e.preventDefault)
	e.preventDefault();
	e.cancelBubble = true;
	e.cancel = true;
	e.returnValue = false;
	return false;
}


TINY.scroll=function(){return{init:function(e,d,s){
		e=typeof e=='object'?e:$(e);
		e.s111=-parseInt(e.style.left||TINY.style.val(e,'left'));
		var l=d>0?e.offsetWidth-e.parentNode.offsetWidth:0;clearInterval(e.si);
		e.si=setInterval(function(){TINY.scroll.mv(e,l,d,s)},20)},
	
		mv:function(e,l,d,s){
			var c=e.s111, i=(d>0)?l-c:c;
				i=i<s?i:s;e.s111=c=c+i*d;
				e.style.left=-c+'px';
			if(c==l){this.cl(e)}
		},
		cl:function(e){e=typeof e=='object'?e:$(e);clearInterval(e.si)}}
}();
	
	
TINY.scrollTo=function(){return{init:function(e,l,s){

		if(e.stopScrollTo)return;
		e.st111=-parseInt(e.style.left||TINY.style.val(e,'left'));
		var d=(e.st111<l)?1:-1;clearInterval(e.siTo);
		e.siTo=setInterval(function(){TINY.scrollTo.mv(e,l,d,s)},20)},
		
		mv:function(e,l,d,s){
			var c=e.st111, i=Math.abs(l-c);
				i=(i==0)?0:i/s+1;
				e.st111=c=c+i*d;
				e.style.left=-c+'px';
			if((d==-1 && c<=l)||(d==1 && c>=l)){this.cl(e)}
		},
		cl:function(e){clearInterval(e.siTo)}}
}();

TINY.width=function(){return{
		set:function(e,h,s){e=typeof e=='object'?e:$(e);
			e.w111=e.offsetWidth;
			clearInterval(e.si1); e.si1=setInterval(function(){TINY.width.tw(e,h,s)},20);
		},
		tw:function(e,h,s){
			var oh=e.w111,x;
			e.w111=x=oh+tin((h-oh)/s);e.style.width=x+'px';mol.marginLeft=-(x+20)/2+'px';if(x==h){clearInterval(e.si1)}
		}
	}
}();
		
TINY.height=function(){return{
		set:function(e,h,s){e=typeof e=='object'?e:$(e);
			e.h111=e.offsetHeight;
			clearInterval(e.si);e.si=setInterval(function(){TINY.height.tw(e,h,s)},20)
		},
		tw:function(e,h,s){
			e.h111=e.h111+tin((h-e.h111)/s);e.style.height=e.h111+'px';if(e.h111==h){clearInterval(e.si)}
		}
	}
}();

TINY.alpha=function(){return{
		set:function(e,a,s,k){e=typeof e=='object'?e:$(e);k===undefined?0:k;
			e.o111=(e.style.opacity||TINY.style.val(e,'opacity'))*100;
			clearInterval(e.ai);e.ai=setInterval(function(){TINY.alpha.tw(e,a,s,k)},20)
		},
		tw:function(e,a,s,k){
			var o=e.o111; e.o111=o=o+tin((a-o)/s);
			if(ie)e.style.filter='alpha(opacity='+o+')'; else e.style.opacity=o/100;
			if(o==a){clearInterval(e.ai);if(k)e.style.visibility='hidden'}
		}
	}
}();

TINY.shadow=function(){return{
		set:function(e,start,h,s){
			e.sha = start; h = (h-start)/s; if(!h)return;
			clearInterval(e.shi);e.shi=setInterval(function(){TINY.shadow.tw(e,h)},70)
		},
		tw:function(e,h){
			e.sha=e.sha+h; fuck(e, e.sha);if(e.sha<=0 || e.sha>=1){clearInterval(e.shi);if(e.sha<=0)fuckoff(e)};
		}
	}
}();
		
TINY.style=function(){return{val:function(e,p){e=typeof e=='object'?e:$(e);return e.currentStyle?e.currentStyle[p]:document.defaultView.getComputedStyle(e,null).getPropertyValue(p)}}}();/*todo test*/

function tin(x){
	return (x>0)?Math.ceil(x):Math.floor(x);
}
function fuck(el, s){
	if(!s){
		var shadowSettings = '3px 5px 3px rgba(90,90,90,100';s='';
	}
	with (el.style){
		boxShadow = webkitBoxShadow = MozBoxShadow = shadowSettings + s + ')';
	}
}
function fuckoff(el){
	with (el.style){
		boxShadow = webkitBoxShadow = MozBoxShadow = '';
	}
}

















/////////////////////////////
function winSize(){
	var _ = document.documentElement, __ = window;
	if (__.innerHeight) { // Everyone but IE
		w = __.innerWidth;
		h = __.innerHeight;
	} else { // IE6 Strict +
		w = _.clientWidth;
		h = _.clientHeight;
	}
}
	

	
	var ____w, ____h, ____s, w, h;
	var mo1 = $('molbert');
	if(mo1)mol = mo1.style;
	var fo  = $('fon');
	var fon = fo.style;
	
	var nav = $('nav').style;
	var log = $('logo').style;
	var con = $('container');
	var zyx = $('zyx');

	
/////////////

	var inter = null;
	var p1 = new Image();
	p1.onload = my_onload;

/////////////


	function force_molbert(){
		force_molbert1 = ['1', '2', 'x', '11', '12', '21', '22', 'y_','left','right'];
		var i = 0, j;
		for(i; i<10; i++){
			j=new Image;
			j.src = 'images/' + force_molbert1[i] + '.png';
			force_molbert1[i] = j;
		}
	}

	function my_onload(){
		
			____w = p1.width;
			____h = p1.height;
			____s = ____w/____h;

			fo.src = p1.src;
	
			if(!inter){
				a();
				inter = setInterval(a, 300);
				try{$('loading').style.display = 'none';}catch(e){}
				log.display = 'block';
				fon.visibility = 'visible';
				if(mo1)force_molbert();
			}else{
				a();
			}
			
	};

		
	function a(){
			winSize();
			var s = w/h;

			if(____w && ____h){
				if(s < ____s){
					fon.width = ____w*(h/____h) + 'px';
					fon.height = h + 'px';
					fon.left = ____h*(s - ____s)/2 + 'px';
					fon.top = '0px';
				}else if(s > ____s){
					fon.width = w + 'px';
					fon.height = ____h*(w/____w) + 'px';
					fon.left = '0px';
					fon.top = -____w*(s - ____s)/2 + 'px';
				}
			}else
				fon.height = h + 'px';


		if(mo1){
			if(h>600 && h<740)
				mol.marginTop='-270px';//'-250px';-370/
			else
				mol.marginTop='-340px';			
		}	//ite
		

		log.right = zyx.offsetWidth-69+'px';//?todo test
		
		if(con.offsetHeight <= h){
			nav.width = w-16+'px';
		}else{
			nav.width = w+'px';
		}
			
	}	
	

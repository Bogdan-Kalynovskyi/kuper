function $(i){return document.getElementById(i)}function $$(e,p){p=p||document;return p.getElementsByTagName(e)}var menuSlider=function(){
	var m,e,g,s,q,i; e=[]; q=8; i=18;
	return{
		init:function(j,k){
			m=$(j); e=$$('li', m);
			var i,l,w,p; i=0; l=e.length;
			for(i;i<l;i++){
				var c,v; c=e[i]; v=c.value;
				
				c.onmouseover=function(){menuSlider.mo(this)}; 
				c.onmouseout=function(){menuSlider.mo(s)};
					
				if(v==1){s=c; c=c.childNodes[0]; w=c.offsetWidth; p=c.offsetLeft}
				
			}
			g=$(k); g.style.width=w+'px'; g.style.left=p+'px';
		},
		mo:function(d){
			d=d.childNodes[0];
				
			clearInterval(m.tm);
			var el,ew; el=d.offsetLeft; ew=d.offsetWidth;
			m.tm=setInterval(function(){menuSlider.mv(el,ew)},i);
		},
		mv:function(el,ew){
			var l,w; l=g.offsetLeft; w=g.offsetWidth;
			if(l!=el||w!=ew){
				if(l!=el){var ld,lr,li; ld=(l>el)?-1:1; lr=Math.abs(el-l); li=(lr<=1)?lr:lr/q+1; g.style.left=(l+ld*li)+'px'}
				if(w!=ew){var wd,wr,wi; wd=(w>ew)?-1:1; wr=Math.abs(ew-w); wi=(wr<=1)?wr:wr/q+1; g.style.width=(w+wd*wi)+'px'}
			}else{clearInterval(m.tm)}
}};}();
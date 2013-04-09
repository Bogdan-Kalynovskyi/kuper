

wheel = function(e){
	var delta = 0;
	if (!e) e = window.event;
	if (e.wheelDelta) {
		delta = e.wheelDelta/120; 
		if (window.opera) delta = -delta;
	} else if (e.detail) {
		delta = -e.detail/3;
	}
	/*!*/ delta *= 2;
	if (delta && mol.display=='table'){

		slideshow.handle(delta);
  		return cancelEvent(e);

    }
}

getKey = function(e){
	if (! e) e = window.event;
	var	t = e.keyCode;
	if (t == 32 || t == 13 || t == 39 || t == 40 || t == 34) {
		slideshow.mv(1,1);
	}
	if (t == 37 || t == 38 || t == 33 || t == 27) {
		slideshow.mv(-1,1);
	}
}


///////////////////////////////////////////////////////////////////


slideshow=function(n, auto){
	this.infoS=3;
	this.scrollS=4;
	this.imgSpeed=20;
	this.speed=7000;
	this.thumbOpacity=70;this.navHover=70;
	this.navOpacity=31;
	this.n=n;
	this.c=0;
	this.a=[];

	this.thumbs="slider";
	this.spacing=4;
	
	this.s=$("slideshow");
	this.q=$("imglink");
	this.f=$("image");
	this.wr=$("wrapper");
	this.info=$("information");
	this.ss=$("slidearea");
	this.p=$(this.thumbs);

		var self = this;
		this.a=_7a;
		
/////////////		
		if(this.thumbs){
//			var u=$("slideleft"),	r=$("slideright");
			var b=$("imgprev"),	f=$("imgnext");
			
		/*	u.onmouseover=new Function('TINY.scroll.init("'+this.thumbs+'",-1,'+this.scrollS+')');
			r.onmouseover=new Function('TINY.scroll.init("'+this.thumbs+'", 1,'+this.scrollS+')');
			u.onmousedown=new Function('TINY.scroll.init("'+this.thumbs+'",-1,'+this.scrollS*3+')');
			r.onmousedown=new Function('TINY.scroll.init("'+this.thumbs+'", 1,'+this.scrollS*3+')');*///\\optimize?
			this.ss.onmouseout=/*u.onmouseout=r.onmouseout=u.onmouseup=r.onmouseup=*/function(){TINY.scroll.cl(self.p)};
			
			this.ss.onmousemove=this.ss.onmouseover=this.shit;
			
			this.p.stopScrollTo = false;
			this.stopShitTo = false;		

			////////////
			var m=/*$$('img',this.p)/*todo!!!!*/this.p.childNodes, w=0;
			this.aa=m;	
			this.l=m.length;
		
////////////////////
			var g, gg;

			for(var i=0; i<this.l; i++){
				
				try{if(!m[i].complete)m[i].reload();}catch(e){}
				if(window.opera){m[i].style.display='inline'}
		
				g=m[i];
				gg=g.width+4;
				if(!gg)gg = g.offsetWidth;
				w+=gg;
				
				if(i!=this.l-1){
					g.style.marginRight=this.spacing+'px';
					w+=this.spacing
				}
		
	
				g.onmouseover=function(){TINY.alpha.set(this,100,5)};
				g.onmouseout=function(){if(!this.style.borderColor)TINY.alpha.set(this,self.thumbOpacity,7)};//DODO JSPERF VS new Func
				g.onclick=new Function(this.n+'.pr('+i+',1)')//function(i){self.pr(i,1)}
			}
		}
		
		if(this.thumbs){
			this.p.style.width=w+'px';
		}

		
		if(b&&f){
			b.style.opacity=f.style.opacity=this.navOpacity/100;
			b.style.filter=f.style.filter='alpha(opacity='+this.navOpacity+')';
			b.onmouseover=f.onmouseover=new Function('TINY.alpha.set(this,'+this.navHover+',4)');
			b.onmouseout=f.onmouseout=new Function('TINY.alpha.set(this,'+this.navOpacity+',6)');
			b.onclick= function(){self.mv(-1,1)};
			f.onclick= function(){self.mv(1,1)}
		}
		
		
/////////// global overall events
		if (window.addEventListener){
			window.addEventListener('DOMMouseScroll', wheel, false);
			//not working!!!!window.addEventListener('keypressed', getKey, false);todo
		}else{
			window.onmousewheel = document.onmousewheel = wheel;
			var savedkp = document.onkeypress;
			if(savedkp){ document.onkeypress = function(e){
					savedkp(e);
					getKey;
			}}
			else{
				document.onkeypress = getKey;
			}
		}		
		
/////////// autorun		
	this.xx = this.ss.offsetWidth, this.x = this.p.offsetWidth - this.xx;
		if(auto) this.is(0,0);/*this.is(0,1)*/''

};	
	
slideshow.prototype={
	
/////////////////////////////////////////////////////////
zoomClick1:function(m,s,event){

		clearTimeout(slideshow.lt);
		clearTimeout(slideshow.at);//
		return zoomClick(m[m.length-1], slideshow.a[s].l, slideshow.a[s].t, event);	

},


stopScroller:function(){
	TINY.scrollTo.cl(slideshow.p)
	this.p.stopScrollTo = true;
	this.p.ttt = setTimeout('slideshow.p.stopScrollTo=false', 2000);
},
stopShit:function(){
	TINY.scroll.cl(slideshow.p)
	this.stopShitTo = true;
	this.ttt = setTimeout('slideshow.stopShitTo=false', 1000);//5000 addlistenet mousein/out
},


handle:function(d){
	this.stopScroller();
	this.stopShit();
		
	var l = parseInt(this.p.style.left||TINY.style.val(this.p,'left')) + d*20;
	if(l>0 || l<-x)return;
	this.p.style.left=l+'px';
},
/////////////////////////////////////////////////////////


shit:function(e){
	if(slideshow.stopShitTo)return;
	
	var pos_x = (ie)?window.event.offsetX:e.pageX - slideshow.ss.offsetLeft - mo1.offsetLeft, yy, zz=11;

	if(pos_x >= 0 && pos_x < this.xx/2){
			yy=(this.xx/2 - pos_x)/zz;
			TINY.scroll.init(slideshow.p, -1, yy);
	}else if(pos_x > this.xx/2 && pos_x <= this.xx){
			yy=(pos_x - this.xx/2)/zz;
			TINY.scroll.init(slideshow.p, 1, yy);
	}else{
			TINY.scroll.cl(slideshow.p);
	}
	
	slideshow.stopScroller();
},



	
mv:function(d,c/*c is very important* and folowed*/){
	var t=this.c+d;
	this.c=t=(t<0)?this.l-1:(t>this.l-1)?0:t;
	this.pr(t,c)},
	
pr:function(t,c){
	clearTimeout(this.lt);
	if(c){
		clearTimeout(this.at)
	}
	this.c=t;
	this.is(t,c);
},



////////////////
	is:function(s,c){
		mol.visibility='visible';
		if(this.a[s].s){
			TINY.height.set(this.info,0,this.infoS);
		}
		
		this.i=new Image();
		
		this.i.style.opacity=0;
		this.i.style.filter='alpha(opacity=0)';
		this.i.onload=new Function(this.n+'.le('+s+','+c+')');
		this.i.src=this.a[s].p;
		

		setTimeout('p1.src=slideshow.a['+s+'].u', 300);
		
		var nxt = (s+1<this.l)?s+1:0;
		var nxx = (s+2<this.l)?s+2:1;

		p0.src=this.a[nxt].p;
		p0.onload = new Function('p0.onload=null;p0.src = "'+this.a[nxx].p+'"');
		if(this.a[nxt].u)
			p2.src=this.a[nxt].u;
		p2.onload = new Function('p2.onload=null;p2.src = "'+this.a[nxx].u+'"');

		if(this.thumbs){
			var l=this.aa.length,x=0,xxx=0;
			for(x;x<l;x++){
				var a = this.aa[x];
				a.style.borderColor = x!=s?'':'#000';//TODO LAST!!!//CURRENT!!!
				a.style.opacity = x!=s?this.thumbOpacity/100:1;

				if(x==s)xxx=a.offsetLeft;
			}
			TINY.scrollTo.init(this.p, xxx, 11);
		}
	},
	
	le:function(s,c){
	
		this.f.appendChild(this.i);
		
		m=this.f.childNodes;
		var ml=m.length;
		
		var x=(ie)?m[ml-1].offsetWidth:m[ml-1].width,//be aware of clientwidth//what is better offset or width - faster?
		b=Math.max(x, 372);

		if(ml!=1){
			TINY.width.set(this.wr, b,this.imgSpeed/10);
			TINY.alpha.set(this.i,100,this.imgSpeed);		
		}else{
			this.wr.style.width= b+'px';
			mol.marginLeft=-(b+20)/2+'px';
			
			this.i.style.opacity = 1;
			this.i.style.filter='alpha(opacity=100)';
		}
		this.i.style.marginLeft= -x/2+'px';
		

		
		
		if(ml>1)
			TINY.alpha.set(m[ml-2],0,this.imgSpeed/2, true);

			
		var n=new Function(this.n+'.nf('+s+')');
		this.lt=setTimeout(n,this.imgSpeed*22);

		if(!c){
			this.at=setTimeout(new Function(this.n+'.mv(1,0)'),this.speed)
		}
		if(this.a[s].l){
			this.q.onmouseover=function(){TINY.alpha.set(this, slideshow.navHover,4);zoomPreload(slideshow.a[s].l);}; 
			this.q.onmouseout=function(){TINY.alpha.set(this, 0,7)};
			this.q.onclick = function(event){slideshow.zoomClick1(m,s,event)};
			this.q.style.visibility='visible';
		}else{
			this.q.onclick=this.q.onmouseover=null;
			this.q.style.visibility='hidden';
		}
		
		if(ml>2){
			this.f.removeChild(m[0])
		}
},


//show text
	nf:function(s){
		var s=this.a[s];
		if(s.t){
			this.info.childNodes[0].innerHTML=s.t;
			this.info.childNodes[1].innerHTML=s.d;
			this.info.style.height='auto';
			var h=this.info.offsetHeight;
			this.info.style.height=0;
			TINY.height.set(this.info,h,this.infoS)
		}
	}
};
		

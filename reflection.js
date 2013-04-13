document.getImgByRel = function (className) {
    var children = document.getElementsByTagName('img');
    var elements = [];

    for (var i = 0; i < children.length; i++) {
        var child = children[i];

        if (child.getAttribute('rel') == "reflect") {
            elements.push(child);
        }
    }
    return elements;
}

function addReflections() {
    var rimages = document.getImgByRel('reflect');

    for (i = 0; i < rimages.length; i++) {

        reflect_image(rimages[i])

    }
}


function reflect_image(image) {
    try {
        if (!image.complete) {
            return;
        }

        var k = 2.9;  // aka ratio
        var opacity_start = 0.50;
        var opacity_end = 0.001;
        var mode = 1;  //0 = vertical, 1 = horizontal

        var container = image.parentNode, replace;
        if (replace = container.childNodes.length != 1) {
            container = document.createElement('div');
        } else if (ie && container.tagName.toLower() == 'a') {
            container = document.createElement('a');
            container.href = image.parentNode.href;
            container.title = image.parentNode.title;//tagret
            replace = true;
        }

        container.style.display = 'inline-block';

        var ref_height = image.offsetHeight, ref_width = image.offsetWidth;


        var reflection;

        if (ie) {
            reflection = document.createElement('img');
        } else {
            reflection = document.createElement('canvas');
            var context = reflection.getContext('2d');
        }

        /* reflection.height       = ref_height;
         reflection.width        = ref_width;*/


        if (0 == mode) {
            reflection.style.display = 'block';
            reflection.style.marginTop = '1px';
            reflection.style.height = ref_height / k + 'px';
            reflection.style.width = ref_width + 'px';
        } else {
            reflection.style.cssFloat = 'left';
            reflection.style.styleFloat = 'left';
            reflection.style.marginRight = '1px';
            reflection.style.height = ref_height + 'px';
            reflection.style.width = ref_width / k + 'px';
            container.style.marginLeft = -ref_width / k + 'px';
        }


        /*container.style.width  = div_width + 'px';
         container.style.height = div_height + 'px';*/


        if (ie) {
            reflection.src = image.src;

            if (0 == mode) {
                reflection.style.filter = 'flipv progid:DXImageTransform.Microsoft.Alpha(opacity=' + (opacity_start * 100) + ', style=1, finishOpacity=' + (opacity_end * 100) + ', startx=0, starty=0, finishx=0, finishy=' + (100) + ')';
            } else {
                reflection.style.filter = 'fliph progid:DXImageTransform.Microsoft.Alpha(opacity=' + (opacity_end * 100) + ', style=1, finishOpacity=' + (opacity_start * 100) + ', startx=0, starty=0, finishx=' + (100) + ', finishy=0)';
            }

        } else {

            context.save();
            var gradient;
            reflection.src = image.src;//толбко для того чтоб знвть размкры....
            var z1 = reflection.width, z2 = reflection.height;

            if (0 == mode) {
                context.translate(0, z2 - 1);
                context.scale(1, -1);
                gradient = context.createLinearGradient(0, 0, 0, ref_width * k);
            } else {
                context.translate(z1, 0);
                context.scale(-1, 1);
                gradient = context.createLinearGradient(0, 0, ref_height * k, 0);
            }

            context.drawImage(image, 0, 0, z1, z2);
            context.restore();

            context.globalCompositeOperation = "destination-out";
            gradient.addColorStop(1, "rgba(255, 255, 255, " + (1 - opacity_start) + ")");
            gradient.addColorStop(0, "rgba(255, 255, 255, " + (1 - opacity_end) + ")");
            context.fillStyle = gradient;
            context.rect(0, 0, z1, z2);
            context.fill();
        }


        if (replace) {
            image.parentNode.replaceChild(container, image);
            container.appendChild(image);
        }
        if (ie) {
            container.insertBefore(reflection, container.firstChild);
        } else {
            container.appendChild(reflection);
        }


    } catch (e) {
    }
}


var previousOnload = window.onload;
window.onload = function () {
    if (previousOnload) {
        previousOnload();
    }
    addReflections();
}
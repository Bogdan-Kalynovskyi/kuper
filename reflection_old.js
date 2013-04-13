document.myGetElementsByClassName = function (className) {
    var children = document.getElementsByTagName('img');
    var elements = new Array();

    for (var i = 0; i < children.length; i++) {
        var child = children[i];
        if (child.getAttribute('alt') == "reflect") {
            elements.push(child);
        }
    }
    return elements;
}

function addReflections() {
    var rimages = document.myGetElementsByClassName('reflect');
    for (i = 0; i < rimages.length; i++) {

        reflect_image(rimages[i])
    }
}


function reflect_image(image) {
    var h_coef = 1;  // aka ratio
    var opacity_start = 0.3;
    var opacity_end = 0.001;
    var mode = 1;  //0 = vertical, 1 = horizontal

    // var image      = document.getElementById('image');
    var container = document.createElement('div');
    var ref_height, ref_width, div_height, div_width;

    if (0 == mode) {
        ref_height = Math.floor(image.height * h_coef);
        ref_width = image.width;
        div_height = Math.floor(image.height * (1 + h_coef));
        div_width = ref_width;
    } else {
        ref_width = Math.floor(image.width * h_coef);
        ref_height = image.height;
        div_height = ref_height
        div_width = Math.floor(image.width * (1 + h_coef));
    }

    var reflection;

    if (!window.opera && document.all) {
        reflection = document.createElement('img');
        reflection.src = image.src;
        reflection.style.width = image.width + 'px';

        if (0 == mode) {
            reflection.style.filter = 'flipv progid:DXImageTransform.Microsoft.Alpha(opacity=' + (opacity_start * 100) + ', style=1, finishOpacity=' + (opacity_end * 100) + ', startx=0, starty=0, finishx=0, finishy=' + (h_coef * 100) + ')';
        } else {
            reflection.style.filter = 'fliph progid:DXImageTransform.Microsoft.Alpha(opacity=' + (opacity_end * 100) + ', style=1, finishOpacity=' + (opacity_start * 100) + ', startx=0, starty=0, finishx=' + (h_coef * 100) + ', finishy=0)';
        }

        container.style.width = div_width + 'px';
        container.style.height = div_height + 'px';
        image.parentNode.replaceChild(container, image);
        container.appendChild(image);
        container.appendChild(reflection);
    } else {
        reflection = document.createElement('canvas');
        var context = reflection.getContext('2d');
        reflection.style.height = ref_height + 'px';
        reflection.style.width = ref_width / 3 + 'px';
        reflection.style.cssFloat = 'left';
        reflection.style.marginRight = '1px';
        reflection.height = ref_height;
        reflection.width = ref_width;

        container.style.width = div_width + 'px';
        container.style.height = div_height + 'px';
        image.parentNode.replaceChild(container, image);
        container.appendChild(image);
        container.appendChild(reflection);

        context.save();
        var gradient;

        if (0 == mode) {
            context.translate(0, image.height);
            context.scale(1, -1);
            gradient = context.createLinearGradient(0, 0, 0, ref_height);
        } else {
            context.translate(image.width, 0);
            context.scale(-1, 1);
            gradient = context.createLinearGradient(0, 0, ref_width, 0);
        }

        context.drawImage(image, 0, 0, image.width, image.height);
        context.restore();

        context.globalCompositeOperation = "destination-out";
        gradient.addColorStop(1, "rgba(255, 255, 255, " + (1 - opacity_start) + ")");
        gradient.addColorStop(0, "rgba(255, 255, 255, " + (1 - opacity_end) + ")");
        context.fillStyle = gradient;
        if (-1 != navigator.appVersion.indexOf('WebKit')) {
            context.fill();
        } else {
            context.fillRect(0, 0, image.width, 2 * ref_height);
        }
    }

}

addReflections();

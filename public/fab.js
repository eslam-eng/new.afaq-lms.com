
document.getElementById('placeholder').onchange = function () {
    Addtext(this.value);
}


document.getElementById('remove').onclick = function () {
    canvas.getActiveObjects().forEach((obj) => {
        canvas.remove(obj)
    });
    canvas.discardActiveObject().renderAll()
}

document.getElementById('testttt').onclick = function () {

    // var dataUrl = canvas.toDataURL();
    // console.log(dataUrl);
    // window.location.href = dataUrl;
    // document.getElementById('boxx').innerHTML = "<img src='" + dataUrl + "'>"
    var json = JSON.stringify(canvas.toJSON());
    var template = document.getElementById('cert')
    template.value = json;
    // document.getElementById('certificate_image').style.display = 'none'
    // document.getElementById('certificate_image_buttons').style.display = 'none'
    // document.getElementById('add_items_section').style.display = 'none'

    // console.log(json);
    // console.log(template.value);

};

function zoomIt(factor) {
    var factor = 2;
    canvas.setHeight(canvas.getHeight() * factor);
    canvas.setWidth(canvas.getWidth() * factor);
    if (canvas.backgroundImage) {
        // Need to scale background images as well
        var bi = canvas.backgroundImage;
        bi.width = bi.width * factor; bi.height = bi.height * factor;
    }
    var objects = canvas.getObjects();
    for (var i in objects) {
        var scaleX = objects[i].scaleX;
        var scaleY = objects[i].scaleY;
        var left = objects[i].left;
        var top = objects[i].top;

        var tempScaleX = scaleX * factor;
        var tempScaleY = scaleY * factor;
        var tempLeft = left * factor;
        var tempTop = top * factor;

        objects[i].scaleX = tempScaleX;
        objects[i].scaleY = tempScaleY;
        objects[i].left = tempLeft;
        objects[i].top = tempTop;

        objects[i].setCoords();
    }
    canvas.renderAll();
    canvas.calcOffset();
}
//zoomIt();


//Scale Canvas
function unzoomIt(factor) {
    var factor = .5;
    canvas.setHeight(canvas.getHeight() * factor);
    canvas.setWidth(canvas.getWidth() * factor);
    if (canvas.backgroundImage) {
        // Need to scale background images as well
        var bi = canvas.backgroundImage;
        bi.width = bi.width * factor; bi.height = bi.height * factor;
    }
    var objects = canvas.getObjects();
    for (var i in objects) {
        var scaleX = objects[i].scaleX;
        var scaleY = objects[i].scaleY;
        var left = objects[i].left;
        var top = objects[i].top;

        var tempScaleX = scaleX * factor;
        var tempScaleY = scaleY * factor;
        var tempLeft = left * factor;
        var tempTop = top * factor;

        objects[i].scaleX = tempScaleX;
        objects[i].scaleY = tempScaleY;
        objects[i].left = tempLeft;
        objects[i].top = tempTop;

        objects[i].setCoords();
    }
    canvas.renderAll();
    canvas.calcOffset();
}





fabric.Object.prototype.transparentCorners = false;
fabric.Object.prototype.padding = 5;



var $ = function (id) { return document.getElementById(id) };


var canvas = this.__canvas = new fabric.Canvas('c');

// canvas.setBackgroundImage("http://sna.test/storage/829/621c9043e4b31_164603910781356.png", canvas.renderAll.bind(canvas), {
//     backgroundImageOpacity: 1,
// });
var cheight = canvas.setHeight(canvas.height); //600
var cwidth = canvas.setWidth(canvas.width); //900

 var cheight;
 var cwidth;

// //canvas.backgroundColor = 'red';

// var site_url = 'http://sna.test/storage/828/FMsW7gmXEAUe9oW.jpg';

document.getElementById('image').onchange =
    function handleImage(e) {
        document.getElementById('certificate_image').style.display = 'block';
        document.getElementById('certificate_image_buttons').style.display = 'flex';
        document.getElementById('certificate_image_buttons').style.flexDirection = 'row-reverse';
        document.getElementById('add_items_section').style.display = 'flex';
        document.getElementById('add_items_section').style.flexDirection = 'row-reverse';
        var reader = new FileReader();
        reader.onload = function (event) {
            console.log('fdsf');
            var imgObj = new Image();

            imgObj.src = event.target.result;
            imgObj.onload = function () {
                // start fabricJS stuff

                var image = new fabric.Image(imgObj);
                // image.set({
                //     left: 100,
                //     right:100,
                //     top: 0,
                //     angle: 0,
                //     padding: 10,
                //     cornersize: 100
                // });
                // image.scale(getRandomNum(0.1, 0.25)).setCoords();
                // image.scale(0.2);
                // canvas.add(image);

                //image.scaleToWidth(canvas.width);
                // image.scaleToHeight(canvas.height);

                cheight = canvas.setHeight(canvas.height); //600
                cwidth = canvas.setWidth(canvas.width); //900

                canvas.setBackgroundImage(image);
                canvas.requestRenderAll();
                // end fabricJS stuff
            }

        }
        reader.readAsDataURL(e.target.files[0]);
    }

// function (event) {
//     document.getElementById('certificate_image').style.display = 'block'
//     let tmppath = URL.createObjectURL(event.target.files[0]);

//     // fabric.Image.fromURL(tmppath, function (img) {
//     //     canvas.add(img);
//     //     img.center().setCoords();
//     //     canvas.renderAll();
//     // });

//     // canvas.setBackgroundImage(tmppath, canvas.renderAll.bind(canvas), {
//     //     backgroundImageOpacity: 1,
//     // });
// };

fabric.Image.fromURL('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdKgmfKEMbsxqE4WwPeUQDYeqb619rnPvUnciLyJG_WLWKw5S7t6qRHlw0AcH7PcbRnQY&usqp=CAU', function (myImg) {
    //i create an extra var for to change some image properties
    myImg.set({
        left: 50,
        top: canvas.height / 1.5
    });
    myImg.scaleToWidth(canvas.width / 4);
    myImg.scaleToHeight(canvas.height / 4);
    canvas.add(myImg);
});

document.getElementById('new_image').onchange = function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var imgObj = new Image();
        imgObj.src = event.target.result;
        imgObj.onload = function () {
            // start fabricJS stuff

            var image = new fabric.Image(imgObj);
            image.set({
                left: 0,
                top: 0,
                angle: 20,
                padding: 10,
                cornersize: 10
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();
            canvas.add(image);

            // end fabricJS stuff
        }

    }
    reader.readAsDataURL(e.target.files[0]);
}

// function (event) {
//     let tmppath = URL.createObjectURL(event.target.files[0]);

//     fabric.Image.fromURL(tmppath, function (myImg) {
//         //i create an extra var for to change some image properties
//         // var img1 = myImg.set({ left: 0, top: 0, width: 150, height: 150 });
//         canvas.add(myImg);
//     });
// };



fabric.util.addListener(document.getElementById('align'), 'click', function () {
    var align = text.getTextAlign();
    if (align === 'right') {

        text.set({
            textAlign: 'left',
            originX: 'left',
            left: rect.left
        });

        text.set({
            textAlign: 'center',
            originX: 'center',
            left: rect.center
        });


    } else {
        text.set({
            textAlign: 'right',
            originX: 'right',
            left: rect.left + rect.width
            //left: rect.right
        });
    }
    text.setCoords();
    canvas.renderAll();
});


function Addtext(t = null) {
    if (!t) {
        t = 'write text here'
    }
    canvas.add(new fabric.Textbox(t, {
        left: 0,
        top: 0,
        width:840,
        fontFamily: 'arial black',
        textAlign: 'center',
        fill: '#333',
        fontSize: 20,
    }));
}

document.getElementById('text-color').onchange = function () {
    canvas.getActiveObject().setFill(this.value);
    canvas.renderAll();
}
document.getElementById('text-color').onchange = function () {
    canvas.getActiveObject().setFill(this.value);
    canvas.renderAll();
};

document.getElementById('text-bg-color').onchange = function () {
    canvas.getActiveObject().setBackgroundColor(this.value);
    canvas.renderAll();
};

document.getElementById('text-lines-bg-color').onchange = function () {
    canvas.getActiveObject().setTextBackgroundColor(this.value);
    canvas.renderAll();
};

document.getElementById('text-stroke-color').onchange = function () {
    canvas.getActiveObject().setStroke(this.value);
    canvas.renderAll();
};

document.getElementById('text-stroke-width').onchange = function () {
    canvas.getActiveObject().setStrokeWidth(this.value);
    canvas.renderAll();
};

document.getElementById('font-family').onchange = function () {
    canvas.getActiveObject().setFontFamily(this.value);
    canvas.renderAll();
};

document.getElementById('text-font-size').onchange = function () {
    canvas.getActiveObject().setFontSize(this.value);
    canvas.renderAll();
};

document.getElementById('text-line-height').onchange = function () {
    canvas.getActiveObject().setLineHeight(this.value);
    canvas.renderAll();
};

document.getElementById('text-align').onchange = function () {
    canvas.getActiveObject().setTextAlign(this.value);
    //canvas.getActiveObject().setoriginX(this.value);
    canvas.renderAll();
};


radios5 = document.getElementsByName("fonttype");  // wijzig naar button
for (var i = 0, max = radios5.length; i < max; i++) {
    radios5[i].onclick = function () {

        if (document.getElementById(this.id).checked == true) {
            if (this.id == "text-cmd-bold") {
                canvas.getActiveObject().set("fontWeight", "bold");
            }
            if (this.id == "text-cmd-italic") {
                canvas.getActiveObject().set("fontStyle", "italic");
            }
            if (this.id == "text-cmd-underline") {
                canvas.getActiveObject().set("textDecoration", "underline");
            }
            if (this.id == "text-cmd-linethrough") {
                canvas.getActiveObject().set("textDecoration", "line-through");
            }
            if (this.id == "text-cmd-overline") {
                canvas.getActiveObject().set("textDecoration", "overline");
            }

        } else {
            if (this.id == "text-cmd-bold") {
                canvas.getActiveObject().set("fontWeight", "");
            }
            if (this.id == "text-cmd-italic") {
                canvas.getActiveObject().set("fontStyle", "");
            }
            if (this.id == "text-cmd-underline") {
                canvas.getActiveObject().set("textDecoration", "");
            }
            if (this.id == "text-cmd-linethrough") {
                canvas.getActiveObject().set("textDecoration", "");
            }
            if (this.id == "text-cmd-overline") {
                canvas.getActiveObject().set("textDecoration", "");
            }
        }


        canvas.renderAll();
    }
}






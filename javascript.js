canvas = document.getElementById('logo');
context = canvas.getContext('2d');
context.font= 'bold italic 57px Georgia';
context.textBaseline='top';
image = new Image();
image.src='huehue-brbr-png-6.png';



image.onload = function ()
{
    gradiant = context.createLinearGradient(0,0,0,89);
    gradiant.addColorStop(0.00,'#faa');
    gradiant.addColorStop(0.66,'#f00');
    context.fillStyle=gradiant;
    context.fillText("HueHueBrBr", 0,0)
    context.strokeText("HueHueBrBr",0,0)
    context.drawImage(image,404,0, image.width /8, image.height/8)

}



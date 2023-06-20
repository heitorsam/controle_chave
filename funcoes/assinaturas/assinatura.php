<!DOCTYPE html>
<html>
<head>
  <title>Assinatura</title>
</head>
<body>

  <button id="btn_limpar">Limpar</button>
  <br>
  <canvas id="canvas" width="400" height="90" style="border-bottom: 2px solid #000;"></canvas>
  <br>
  Assinatura
  <br>

  <script>

    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    var lastX = 0;
    var lastY = 0;
    var isMouseDown = false;

    function draw(x, y) {

      if (!isMouseDown) return;

      context.beginPath();
      context.strokeStyle = "#000";
      context.lineWidth = 2;
      context.moveTo(lastX, lastY);
      context.lineTo(x, y);
      context.stroke();
      context.closePath();

      lastX = x;
      lastY = y;

    }

    canvas.addEventListener("mousedown", function (event) {

      isMouseDown = true;
      lastX = event.clientX - canvas.offsetLeft;
      lastY = event.clientY - canvas.offsetTop;

    });

    canvas.addEventListener("mouseup", function () {

      isMouseDown = false;

    });

    canvas.addEventListener("mousemove", function (event) {

      var x = event.clientX - canvas.offsetLeft;
      var y = event.clientY - canvas.offsetTop;
      draw(x, y);

    });

    document.getElementById("btn_limpar").addEventListener("click", function () {

      context.clearRect(0, 0, canvas.width, canvas.height);

    });
    
  </script>
</body>
</html>

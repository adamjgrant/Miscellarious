define(['jquery', './style.css!', './markup.txt!text', 'ks:tinygrowl'], function($, css, markup) {
  var pongId = 'pong'
  $('#' + pongId).html(markup);
  (function (fld, pF, px, py, dx, dy, lifes, score) {
    var cycle = setInterval(function () {
      var bx = pF(ball.style.left = pF(ball.style.left) + dx + 'px'),
        by = pF(ball.style.top = pF(ball.style.top) + dy + 'px'),
        row = ((by - 30) / 14) | 0, col = (bx / 32) | 0;

      if (bx < 0 && dx < 0 || bx >= 314 && dx > 0) dx *= -1;
      if (bx + 6 >= px && bx + 6 <= px + 64 && by >= 259 && by <= 264) {
        dy *= -1;
        if (bx + 6 <= px + 21) dx = -6;
        else if (bx + 6 >= px + 43) dx = 6;
        else if (Math.abs(dx) == 6) dx = (dx * 2 / 3) | 0;
      }
      if (by < 0) dy *= -1;
      if (by >= 288 && !--lifes) clearInterval(cycle), $.growl({title:'Game over!', type: 'danger', delay: 2000, container: '#pong'}), $('body').css('cursor', 'default !important');
      if (by >= 288 && lifes) dy *= -1, lifesNode.innerHTML = lifes;
      if (by >= 18 && by <= 100 && fld[row * 10 + col].className != 'removed') {
        dy *= -1, fld[row * 10 + col].className = 'removed';
        if (dx < 0 && ((bx | 0) % 32 < 10 || (bx | 0) % 32 > 22)) dx *= -1;
        if (dx > 0 && (((bx + 12) | 0) % 32 < 10 || ((bx + 12) | 0) % 32 > 22)) dx *= -1;
        scoreNode.innerHTML = ++score;
        if (score == 50) clearInterval(cycle), alert('Victory!');
      }
    }, 1000 / 60);

    document.addEventListener('mousemove', function (e) {
      var ePageX = e.pageX - $('#' + pongId).offset().left
      var ePageY = e.pageY - $('#' + pongId).offset().top
      px = (ePageX > 40) ? ((ePageX < 290) ? ePageX - 40 : 256) : 0;
      paddle.style.left = px + 'px';
    }, false);
  }(field.children, parseFloat, 129, 270, -4, -4, 5, 0));
})
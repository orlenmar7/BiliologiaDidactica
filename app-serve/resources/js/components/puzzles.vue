<template>
  <div >
    <div>
      <h2>Rompe cabezas {{ historiy.title }} <i class="icon-puzzle icons"></i></h2>
      <span style="background: #1478f8; color: #fff;padding: 5px 13px;border-radius: 10px;"> Categoría: {{ historiy.category.name }} </span>
      <hr>
    </div>

    <div class="col-md-12" style="height: 450px;">
      <div style="border: 0px solid ; position: absolute; left: 0px; top: 0px; width 100%;">
        <canvas id="canvas"></canvas>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
import swal from 'sweetalert2'

export default {

  middleware: ['auth'],
  scrollToTop: false,
    props: ['props_history'],


  data: () => ({
    title: 'Rompe cabezas',
    history_id: null,
    historiy: {
      category: {
        name: ''
      }
    },
    words: [],
  }),

  methods: {
    main (){
      if (this.history_id) {
            this.getHistoriy(this.history_id)
        }
    },
    loadWords (arrayImagenes) {

      const PUZZLE_DIFFICULTY = 4;
      const PUZZLE_HOVER_TINT = '#009900';

      var _stage;
      var _canvas;

      var _img;
      var _pieces;
      var _puzzleWidth;
      var _puzzleHeight;
      var _pieceWidth;
      var _pieceHeight;
      var _currentPiece;
      var _currentDropPiece;

      var _mouse;

      function init(){
          _img = new Image();
          _img.addEventListener('load',onImage,false);
          _img.src = arrayImagenes[ numerosAleatorios(0 , arrayImagenes.length - 1) ];

          _img.style.width = '100%';
      }
      function onImage(e){
          _pieceWidth = Math.floor(_img.width / PUZZLE_DIFFICULTY)
          _pieceHeight = Math.floor(_img.height / PUZZLE_DIFFICULTY)
          _puzzleWidth = _pieceWidth * PUZZLE_DIFFICULTY;
          _puzzleHeight = _pieceHeight * PUZZLE_DIFFICULTY;
          setCanvas();
          initPuzzle();
      }
      function setCanvas(){
          _canvas = document.getElementById('canvas');
          _stage = _canvas.getContext('2d');
          _canvas.width = _puzzleWidth;
          _canvas.height = _puzzleHeight;
      }
      function initPuzzle(){
          _pieces = [];
          _mouse = {x:0,y:0};
          _currentPiece = null;
          _currentDropPiece = null;
          _stage.drawImage(_img, 0, 0, _puzzleWidth, _puzzleHeight, 0, 0, _puzzleWidth, _puzzleHeight);
          createTitle("Pulsa sobre la imagen para comenzar.");
          buildPieces();
      }
      function createTitle(msg){
          _stage.fillStyle = "#000000";
          _stage.globalAlpha = .4;
          _stage.fillRect(100,_puzzleHeight - 40,_puzzleWidth - 200,40);
          _stage.fillStyle = "#FFFFFF";
          _stage.globalAlpha = 1;
          _stage.textAlign = "center";
          _stage.textBaseline = "middle";
          _stage.font = "20px Arial";
          _stage.fillText(msg,_puzzleWidth / 2,_puzzleHeight - 20);
      }
      function buildPieces(){
          var i;
          var piece;
          var xPos = 0;
          var yPos = 0;
          for(i = 0;i < PUZZLE_DIFFICULTY * PUZZLE_DIFFICULTY;i++){
              piece = {};
              piece.sx = xPos;
              piece.sy = yPos;
              _pieces.push(piece);
              xPos += _pieceWidth;
              if(xPos >= _puzzleWidth){
                  xPos = 0;
                  yPos += _pieceHeight;
              }
          }
          document.onmousedown = shufflePuzzle;
      }
      function shufflePuzzle(){
          _pieces = shuffleArray(_pieces);
          _stage.clearRect(0,0,_puzzleWidth,_puzzleHeight);
          var i;
          var piece;
          var xPos = 0;
          var yPos = 0;
          for(i = 0;i < _pieces.length;i++){
              piece = _pieces[i];
              piece.xPos = xPos;
              piece.yPos = yPos;
              _stage.drawImage(_img, piece.sx, piece.sy, _pieceWidth, _pieceHeight, xPos, yPos, _pieceWidth, _pieceHeight);
              _stage.strokeRect(xPos, yPos, _pieceWidth,_pieceHeight);
              xPos += _pieceWidth;
              if(xPos >= _puzzleWidth){
                  xPos = 0;
                  yPos += _pieceHeight;
              }
          }
          document.onmousedown = onPuzzleClick;
      }
      function onPuzzleClick(e){
          if(e.layerX || e.layerX == 0){
              _mouse.x = e.layerX - _canvas.offsetLeft;
              _mouse.y = e.layerY - _canvas.offsetTop;
          }
          else if(e.offsetX || e.offsetX == 0){
              _mouse.x = e.offsetX - _canvas.offsetLeft;
              _mouse.y = e.offsetY - _canvas.offsetTop;
          }
          _currentPiece = checkPieceClicked();
          if(_currentPiece != null){
              _stage.clearRect(_currentPiece.xPos,_currentPiece.yPos,_pieceWidth,_pieceHeight);
              _stage.save();
              _stage.globalAlpha = .9;
              _stage.drawImage(_img, _currentPiece.sx, _currentPiece.sy, _pieceWidth, _pieceHeight, _mouse.x - (_pieceWidth / 2), _mouse.y - (_pieceHeight / 2), _pieceWidth, _pieceHeight);
              _stage.restore();
              document.onmousemove = updatePuzzle;
              document.onmouseup = pieceDropped;
          }
      }
      function checkPieceClicked(){
          var i;
          var piece;
          for(i = 0;i < _pieces.length;i++){
              piece = _pieces[i];
              if(_mouse.x < piece.xPos || _mouse.x > (piece.xPos + _pieceWidth) || _mouse.y < piece.yPos || _mouse.y > (piece.yPos + _pieceHeight)){
                  //PIECE NOT HIT
              }
              else{
                  return piece;
              }
          }
          return null;
      }
      function updatePuzzle(e){
          _currentDropPiece = null;
          if(e.layerX || e.layerX == 0){
              _mouse.x = e.layerX - _canvas.offsetLeft;
              _mouse.y = e.layerY - _canvas.offsetTop;
          }
          else if(e.offsetX || e.offsetX == 0){
              _mouse.x = e.offsetX - _canvas.offsetLeft;
              _mouse.y = e.offsetY - _canvas.offsetTop;
          }
          _stage.clearRect(0,0,_puzzleWidth,_puzzleHeight);
          var i;
          var piece;
          for(i = 0;i < _pieces.length;i++){
              piece = _pieces[i];
              if(piece == _currentPiece){
                  continue;
              }
              _stage.drawImage(_img, piece.sx, piece.sy, _pieceWidth, _pieceHeight, piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
              _stage.strokeRect(piece.xPos, piece.yPos, _pieceWidth,_pieceHeight);
              if(_currentDropPiece == null){
                  if(_mouse.x < piece.xPos || _mouse.x > (piece.xPos + _pieceWidth) || _mouse.y < piece.yPos || _mouse.y > (piece.yPos + _pieceHeight)){
                      //NOT OVER
                  }
                  else{
                      _currentDropPiece = piece;
                      _stage.save();
                      _stage.globalAlpha = .4;
                      _stage.fillStyle = PUZZLE_HOVER_TINT;
                      _stage.fillRect(_currentDropPiece.xPos,_currentDropPiece.yPos,_pieceWidth, _pieceHeight);
                      _stage.restore();
                  }
              }
          }
          _stage.save();
          _stage.globalAlpha = .6;
          _stage.drawImage(_img, _currentPiece.sx, _currentPiece.sy, _pieceWidth, _pieceHeight, _mouse.x - (_pieceWidth / 2), _mouse.y - (_pieceHeight / 2), _pieceWidth, _pieceHeight);
          _stage.restore();
          _stage.strokeRect( _mouse.x - (_pieceWidth / 2), _mouse.y - (_pieceHeight / 2), _pieceWidth,_pieceHeight);
      }
      function pieceDropped(e){
          document.onmousemove = null;
          document.onmouseup = null;
          if(_currentDropPiece != null){
              var tmp = {xPos:_currentPiece.xPos,yPos:_currentPiece.yPos};
              _currentPiece.xPos = _currentDropPiece.xPos;
              _currentPiece.yPos = _currentDropPiece.yPos;
              _currentDropPiece.xPos = tmp.xPos;
              _currentDropPiece.yPos = tmp.yPos;
          }
          resetPuzzleAndCheckWin();
      }
      function resetPuzzleAndCheckWin(){
          _stage.clearRect(0,0,_puzzleWidth,_puzzleHeight);
          var gameWin = true;
          var i;
          var piece;
          for(i = 0;i < _pieces.length;i++){
              piece = _pieces[i];
              _stage.drawImage(_img, piece.sx, piece.sy, _pieceWidth, _pieceHeight, piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
              _stage.strokeRect(piece.xPos, piece.yPos, _pieceWidth,_pieceHeight);
              if(piece.xPos != piece.sx || piece.yPos != piece.sy){
                  gameWin = false;
              }
          }
          if(gameWin){

            createTitle("Muy Bien...!");
            setTimeout(gameOver,3000);
          }
      }
      function gameOver(){
          document.onmousedown = null;
          document.onmousemove = null;
          document.onmouseup = null;
          initPuzzle();
      }
      function shuffleArray(o){
          for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
          return o;
      }

      function numerosAleatorios(min , max){
        var numero=Math.floor(Math.random()*(max-min+1))+min;
        return numero;
      }

      init();

    },
    async getHistoriy(id) {
        const {
            data
        } = await axios.get(`/api/admin/histories/${id}`)
        this.historiy = data
        console.log(this.historiy.image_url)
        this.loadWords([this.historiy.image_url])
    },
  },

  mounted() {
    console.log(this.props_history)
    if (this.props_history) {
      var _history = JSON.parse(this.props_history);
      this.history_id = _history.id
    }
    this.main();
  }

}
</script>


<style type="text/css">

/** Trumbowyg v2.4.1 - A lightweight WYSIWYG editor - alex-d.github.io/Trumbowyg - License MIT - Author : Alexandre Demode (Alex-D) / alex-d.fr */
#trumbowyg-icons,#trumbowyg-icons svg{height:0;width:0}#trumbowyg-icons{overflow:hidden;visibility:hidden}.trumbowyg-box *,.trumbowyg-box ::after,.trumbowyg-box ::before{box-sizing:border-box}.trumbowyg-box svg{width:17px;height:100%;fill:#222}.trumbowyg-box,.trumbowyg-editor{display:block;position:relative;border:1px solid #DDD;width:100%;min-height:300px;margin:17px auto}.trumbowyg-box .trumbowyg-editor{margin:0 auto}.trumbowyg-box.trumbowyg-fullscreen{background:#FEFEFE;border:none!important}.trumbowyg-editor,.trumbowyg-textarea{position:relative;box-sizing:border-box;padding:20px;min-height:300px;width:100%;border-style:none;resize:none;outline:0;overflow:auto}.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-box-blur .trumbowyg-editor::before{color:transparent!important;text-shadow:0 0 7px #333}@media screen and (min-width:0 \0){.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-box-blur .trumbowyg-editor::before{color:rgba(200,200,200,.6)!important}}@supports (-ms-accelerator:true){.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-box-blur .trumbowyg-editor::before{color:rgba(200,200,200,.6)!important}}.trumbowyg-box-blur .trumbowyg-editor hr,.trumbowyg-box-blur .trumbowyg-editor img{opacity:.2}.trumbowyg-textarea{position:relative;display:block;overflow:auto;border:none;white-space:normal;font-size:14px;font-family:Inconsolata,Consolas,Courier,"Courier New",sans-serif;line-height:18px}.trumbowyg-box.trumbowyg-editor-visible .trumbowyg-textarea{height:1px!important;width:25%;min-height:0!important;padding:0!important;background:0 0;opacity:0!important}.trumbowyg-box.trumbowyg-editor-hidden .trumbowyg-textarea{display:block}.trumbowyg-box.trumbowyg-editor-hidden .trumbowyg-editor{display:none}.trumbowyg-box.trumbowyg-disabled .trumbowyg-textarea{opacity:.8;background:0 0}.trumbowyg-editor[contenteditable=true]:empty:not(:focus)::before{content:attr(placeholder);color:#999;pointer-events:none}.trumbowyg-button-pane{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap;width:100%;min-height:36px;background:#ecf0f1;border-bottom:1px solid #d7e0e2;margin:0;padding:0 5px;list-style-type:none;line-height:10px;-webkit-backface-visibility:hidden;backface-visibility:hidden}.trumbowyg-button-pane::after{content:" ";display:block;position:absolute;top:36px;left:0;right:0;width:100%;height:1px;background:#d7e0e2}.trumbowyg-button-pane .trumbowyg-button-group{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-flow:row wrap;flex-flow:row wrap}.trumbowyg-button-pane .trumbowyg-button-group .trumbowyg-fullscreen-button svg{color:transparent}.trumbowyg-button-pane .trumbowyg-button-group:not(:empty)+.trumbowyg-button-group::before{content:" ";display:block;width:1px;background:#d7e0e2;margin:0 5px;height:35px}.trumbowyg-button-pane button{display:block;position:relative;width:35px;height:35px;padding:1px 6px!important;margin-bottom:1px;overflow:hidden;border:none;cursor:pointer;background:0 0;-webkit-transition:background-color 150ms,opacity 150ms;transition:background-color 150ms,opacity 150ms}.trumbowyg-button-pane button.trumbowyg-textual-button{width:auto;line-height:35px}.trumbowyg-button-pane.trumbowyg-disable button:not(.trumbowyg-not-disable):not(.trumbowyg-active),.trumbowyg-disabled .trumbowyg-button-pane button:not(.trumbowyg-not-disable):not(.trumbowyg-viewHTML-button){opacity:.2;cursor:default}.trumbowyg-button-pane.trumbowyg-disable .trumbowyg-button-group::before,.trumbowyg-disabled .trumbowyg-button-pane .trumbowyg-button-group::before{background:#e3e9eb}.trumbowyg-button-pane button.trumbowyg-active,.trumbowyg-button-pane button:not(.trumbowyg-disable):focus,.trumbowyg-button-pane button:not(.trumbowyg-disable):hover{background-color:#FFF;outline:0}.trumbowyg-button-pane .trumbowyg-open-dropdown::after{display:block;content:" ";position:absolute;top:25px;right:3px;height:0;width:0;border:3px solid transparent;border-top-color:#555}.trumbowyg-button-pane .trumbowyg-open-dropdown.trumbowyg-textual-button{padding-left:10px!important;padding-right:18px!important}.trumbowyg-button-pane .trumbowyg-open-dropdown.trumbowyg-textual-button::after{top:17px;right:7px}.trumbowyg-button-pane .trumbowyg-right{margin-left:auto}.trumbowyg-button-pane .trumbowyg-right::before{display:none!important}.trumbowyg-dropdown{width:200px;border:1px solid #ecf0f1;padding:5px 0;border-top:none;background:#FFF;margin-left:-1px;box-shadow:rgba(0,0,0,.1) 0 2px 3px}.trumbowyg-dropdown button{display:block;width:100%;height:35px;line-height:35px;text-decoration:none;background:#FFF;padding:0 10px;color:#333!important;border:none;cursor:pointer;text-align:left;font-size:15px;-webkit-transition:all 150ms;transition:all 150ms}.trumbowyg-dropdown button:focus,.trumbowyg-dropdown button:hover{background:#ecf0f1}.trumbowyg-dropdown button svg{float:left;margin-right:14px}.trumbowyg-modal{position:absolute;top:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%);max-width:520px;width:100%;height:350px;z-index:11;overflow:hidden;-webkit-backface-visibility:hidden;backface-visibility:hidden}.trumbowyg-modal-box{position:absolute;top:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%);max-width:500px;width:calc(100% - 20px);padding-bottom:45px;z-index:1;background-color:#FFF;text-align:center;font-size:14px;box-shadow:rgba(0,0,0,.2) 0 2px 3px;-webkit-backface-visibility:hidden;backface-visibility:hidden}.trumbowyg-modal-box .trumbowyg-modal-title{font-size:24px;font-weight:700;margin:0 0 20px;padding:15px 0 13px;display:block;border-bottom:1px solid #EEE;color:#333;background:#fbfcfc}.trumbowyg-modal-box .trumbowyg-progress{width:100%;height:3px;position:absolute;top:58px}.trumbowyg-modal-box .trumbowyg-progress .trumbowyg-progress-bar{background:#2BC06A;height:100%;-webkit-transition:width 150ms linear;transition:width 150ms linear}.trumbowyg-modal-box label{display:block;position:relative;margin:15px 12px;height:29px;line-height:29px;overflow:hidden}.trumbowyg-modal-box label .trumbowyg-input-infos{display:block;text-align:left;height:25px;line-height:25px;-webkit-transition:all 150ms;transition:all 150ms}.trumbowyg-modal-box label .trumbowyg-input-infos span{display:block;color:#69878f;background-color:#fbfcfc;border:1px solid #DEDEDE;padding:0 7px;width:150px}.trumbowyg-modal-box label .trumbowyg-input-infos span.trumbowyg-msg-error{color:#e74c3c}.trumbowyg-modal-box label.trumbowyg-input-error input,.trumbowyg-modal-box label.trumbowyg-input-error textarea{border:1px solid #e74c3c}.trumbowyg-modal-box label.trumbowyg-input-error .trumbowyg-input-infos{margin-top:-27px}.trumbowyg-modal-box label input{position:absolute;top:0;right:0;height:27px;line-height:27px;border:1px solid #DEDEDE;background:#fff;font-size:14px;max-width:330px;width:70%;padding:0 7px;-webkit-transition:all 150ms;transition:all 150ms}.trumbowyg-modal-box label input:focus,.trumbowyg-modal-box label input:hover{outline:0;border:1px solid #95a5a6}.trumbowyg-modal-box label input:focus{background:#fbfcfc}.trumbowyg-modal-box .error{margin-top:25px;display:block;color:red}.trumbowyg-modal-box .trumbowyg-modal-button{position:absolute;bottom:10px;right:0;text-decoration:none;color:#FFF;display:block;width:100px;height:35px;line-height:33px;margin:0 10px;background-color:#333;border:none;cursor:pointer;font-family:"Trebuchet MS",Helvetica,Verdana,sans-serif;font-size:16px;-webkit-transition:all 150ms;transition:all 150ms}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit{right:110px;background:#2bc06a}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:focus,.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:hover{background:#40d47e;outline:0}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:active{background:#25a25a}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset{color:#555;background:#e6e6e6}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:focus,.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:hover{background:#fbfbfb;outline:0}.trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:active{background:#d5d5d5}.trumbowyg-overlay{position:absolute;background-color:rgba(255,255,255,.5);width:100%;left:0;display:none;z-index:10}body.trumbowyg-body-fullscreen{overflow:hidden}.trumbowyg-fullscreen{position:fixed;top:0;left:0;width:100%;height:100%;margin:0;padding:0;z-index:99999}.trumbowyg-fullscreen .trumbowyg-editor,.trumbowyg-fullscreen.trumbowyg-box{border:none}.trumbowyg-fullscreen .trumbowyg-editor,.trumbowyg-fullscreen .trumbowyg-textarea{height:calc(100% - 37px)!important;overflow:auto}.trumbowyg-fullscreen .trumbowyg-overlay{height:100%!important}.trumbowyg-fullscreen .trumbowyg-button-group .trumbowyg-fullscreen-button svg{color:#222;fill:transparent}.trumbowyg-editor embed,.trumbowyg-editor img,.trumbowyg-editor object,.trumbowyg-editor video{max-width:100%}.trumbowyg-editor img,.trumbowyg-editor video{height:auto}.trumbowyg-editor img{cursor:move}.trumbowyg-editor.trumbowyg-reset-css{background:#FEFEFE!important;font-family:"Trebuchet MS",Helvetica,Verdana,sans-serif!important;font-size:14px!important;line-height:1.45em!important;white-space:normal!important;color:#333}.trumbowyg-editor.trumbowyg-reset-css a{color:#15c!important;text-decoration:underline!important}.trumbowyg-editor.trumbowyg-reset-css blockquote,.trumbowyg-editor.trumbowyg-reset-css div,.trumbowyg-editor.trumbowyg-reset-css ol,.trumbowyg-editor.trumbowyg-reset-css p,.trumbowyg-editor.trumbowyg-reset-css ul{box-shadow:none!important;background:0 0!important;margin:0 0 15px!important;line-height:1.4em!important;font-family:"Trebuchet MS",Helvetica,Verdana,sans-serif!important;font-size:14px!important;border:none}.trumbowyg-editor.trumbowyg-reset-css hr,.trumbowyg-editor.trumbowyg-reset-css iframe,.trumbowyg-editor.trumbowyg-reset-css object{margin-bottom:15px!important}.trumbowyg-editor.trumbowyg-reset-css blockquote{margin-left:32px!important;font-style:italic!important;color:#555}.trumbowyg-editor.trumbowyg-reset-css ol,.trumbowyg-editor.trumbowyg-reset-css ul{padding-left:20px!important}.trumbowyg-editor.trumbowyg-reset-css ol ol,.trumbowyg-editor.trumbowyg-reset-css ol ul,.trumbowyg-editor.trumbowyg-reset-css ul ol,.trumbowyg-editor.trumbowyg-reset-css ul ul{border:none;margin:2px!important;padding:0 0 0 24px!important}.trumbowyg-editor.trumbowyg-reset-css hr{display:block;height:1px;border:none;border-top:1px solid #CCC}.trumbowyg-editor.trumbowyg-reset-css h1,.trumbowyg-editor.trumbowyg-reset-css h2,.trumbowyg-editor.trumbowyg-reset-css h3,.trumbowyg-editor.trumbowyg-reset-css h4{color:#111;background:0 0;margin:0!important;padding:0!important;font-weight:700}.trumbowyg-editor.trumbowyg-reset-css h1{font-size:32px!important;line-height:38px!important;margin-bottom:20px!important}.trumbowyg-editor.trumbowyg-reset-css h2{font-size:26px!important;line-height:34px!important;margin-bottom:15px!important}.trumbowyg-editor.trumbowyg-reset-css h3{font-size:22px!important;line-height:28px!important;margin-bottom:7px!important}.trumbowyg-editor.trumbowyg-reset-css h4{font-size:16px!important;line-height:22px!important;margin-bottom:7px!important}.trumbowyg-dark .trumbowyg-textarea{background:#111;color:#ddd}.trumbowyg-dark .trumbowyg-box{border:1px solid #343434}.trumbowyg-dark .trumbowyg-box.trumbowyg-fullscreen{background:#111}.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor::before{text-shadow:0 0 7px #ccc}@media screen and (min-width:0 \0){.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor::before{color:rgba(20,20,20,.6)!important}}@supports (-ms-accelerator:true){.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor *,.trumbowyg-dark .trumbowyg-box.trumbowyg-box-blur .trumbowyg-editor::before{color:rgba(20,20,20,.6)!important}}.trumbowyg-dark .trumbowyg-box svg{fill:#ecf0f1;color:#ecf0f1}.trumbowyg-dark .trumbowyg-button-pane{background-color:#222;border-bottom-color:#343434}.trumbowyg-dark .trumbowyg-button-pane::after{background:#343434}.trumbowyg-dark .trumbowyg-button-pane .trumbowyg-button-group:not(:empty)::before{background-color:#343434}.trumbowyg-dark .trumbowyg-button-pane .trumbowyg-button-group:not(:empty) .trumbowyg-fullscreen-button svg{color:transparent}.trumbowyg-dark .trumbowyg-button-pane.trumbowyg-disable .trumbowyg-button-group::before{background-color:#2a2a2a}.trumbowyg-dark .trumbowyg-button-pane button.trumbowyg-active,.trumbowyg-dark .trumbowyg-button-pane button:not(.trumbowyg-disable):focus,.trumbowyg-dark .trumbowyg-button-pane button:not(.trumbowyg-disable):hover{background-color:#333}.trumbowyg-dark .trumbowyg-button-pane .trumbowyg-open-dropdown::after{border-top-color:#fff}.trumbowyg-dark .trumbowyg-fullscreen .trumbowyg-button-group .trumbowyg-fullscreen-button svg{color:#ecf0f1;fill:transparent}.trumbowyg-dark .trumbowyg-dropdown{border-color:#222;background:#333;box-shadow:rgba(0,0,0,.3) 0 2px 3px}.trumbowyg-dark .trumbowyg-dropdown button{background:#333;color:#fff!important}.trumbowyg-dark .trumbowyg-dropdown button:focus,.trumbowyg-dark .trumbowyg-dropdown button:hover{background:#222}.trumbowyg-dark .trumbowyg-modal-box{background-color:#222}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-title{border-bottom:1px solid #555;color:#fff;background:#3c3c3c}.trumbowyg-dark .trumbowyg-modal-box label{display:block;position:relative;margin:15px 12px;height:27px;line-height:27px;overflow:hidden}.trumbowyg-dark .trumbowyg-modal-box label .trumbowyg-input-infos span{color:#eee;background-color:#2f2f2f;border-color:#222}.trumbowyg-dark .trumbowyg-modal-box label .trumbowyg-input-infos span.trumbowyg-msg-error{color:#e74c3c}.trumbowyg-dark .trumbowyg-modal-box label.trumbowyg-input-error input,.trumbowyg-dark .trumbowyg-modal-box label.trumbowyg-input-error textarea{border-color:#e74c3c}.trumbowyg-dark .trumbowyg-modal-box label input{border-color:#222;color:#eee;background:#333}.trumbowyg-dark .trumbowyg-modal-box label input:focus,.trumbowyg-dark .trumbowyg-modal-box label input:hover{border-color:#626262}.trumbowyg-dark .trumbowyg-modal-box label input:focus{background-color:#2f2f2f}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit{background:#1b7943}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:focus,.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:hover{background:#25a25a}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-submit:active{background:#176437}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset{background:#333;color:#ccc}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:focus,.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:hover{background:#444}.trumbowyg-dark .trumbowyg-modal-box .trumbowyg-modal-button.trumbowyg-modal-reset:active{background:#111}.trumbowyg-dark .trumbowyg-overlay{background-color:rgba(15,15,15,.6)}

</style>

<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
    header("Location: login.html"); // Redireciona para login se não estiver autenticado
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="styles/simulador.css">
  <script src="https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js"></script>
</head>
<body>
  <header>
    <div class="navbar">
      <ul class="links">
        <li class="logo"><a href="#"><img src="imagens/Logo.png" alt="Logotipo Pinturas do Sr. Graça" /></a></li>
        <li><a href="index.php">Início</a></li>
        <li><a href="#">Orçamento</a></li>
        <li><a href="simulador.php">Simulador</a></li>
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        
        <?php if (isset($_SESSION['id']) && $_SESSION['id'] != ''): ?>
                    <button type="button" class="botao-logout" onclick="window.location.href='logout.php'">Logout</button> <!-- Se o utilizador estiver logado, mostra o botão de Logout -->
                <?php else: ?>
                    <button type="button" class="botao-login" onclick="window.location.href='login.html'">Login</button> <!-- Se o utilizador não estiver logado, mostra o botão de Login -->
                <?php endif; ?>      </ul>
    </div>
  </header>
  <div class="layout">
    <div class="controls">
      <label>Escolhe uma cor:</label>
      <input type="color" id="colorPicker" value="#ff0000">
      <label for="wallSelector">Escolhe a parede:</label>
      <select id="wallSelector">
        <option value="frente">Frente</option>
        <option value="esquerda">Esquerda</option>
        <option value="direita">Direita</option>
      </select>
      <label for="floorSelector">Escolhe o tipo de chão:</label>
      <select id="floorSelector">
        <option value="marmore">Mármore</option>
        <option value="madeira-cinza">Madeira Cinza</option>
        <option value="flutuante-castanho-claro">Flutuante castanho claro</option>
        <option value="flutuante-castanho-escuro">Flutuante castanho escuro</option>
        <option value="ceramica">Ceramica</option>
      </select>
    </div>
    
    <div id="scene-container"></div>
</div>
  <script>
    // Setup da cena
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xffffff);

    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 2, 7);
    camera.lookAt(0, 1, 0);

    const renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById('scene-container').appendChild(renderer.domElement);

    // Função para criar uma parede ou chão com contorno preto
    function criarParede(largura, altura, corHex) {
      const geometria = new THREE.PlaneGeometry(largura, altura);
      const material = new THREE.MeshBasicMaterial({ color: corHex, side: THREE.DoubleSide });
      const plano = new THREE.Mesh(geometria, material);

      const contornoGeo = new THREE.EdgesGeometry(geometria);
      const contornoMat = new THREE.LineBasicMaterial({ color: 0x000000 });
      const contorno = new THREE.LineSegments(contornoGeo, contornoMat);
      plano.add(contorno);

      return plano;
    }

    // Medidas
    const largura = 6;
    const altura = 3;
    const profundidade = 5;
    const ajusteAltura = 0.01;

    // Parede da frente
    const paredeFrente = criarParede(largura, altura, 0xffffff);
    paredeFrente.position.set(0, altura / 2 + ajusteAltura, -profundidade / 2);
    scene.add(paredeFrente);

    // Parede esquerda
    const paredeEsquerda = criarParede(profundidade, altura, 0xffffff);
    paredeEsquerda.rotation.y = Math.PI / 2;
    paredeEsquerda.position.set(-largura / 2, altura / 2 + ajusteAltura, 0);
    scene.add(paredeEsquerda);

    // Parede direita
    const paredeDireita = criarParede(profundidade, altura, 0xffffff);
    paredeDireita.rotation.y = -Math.PI / 2;
    paredeDireita.position.set(largura / 2, altura / 2 + ajusteAltura, 0);
    scene.add(paredeDireita);

    // Chão
    const chao = criarParede(largura, profundidade, 0xffffff);
    chao.rotation.x = -Math.PI / 2;
    chao.position.set(0, 0, 0);
    scene.add(chao);

    // Função para mudar a textura do chão
    function mudarTexturaChao(tipo) {
      let textura;
      if (tipo === 'marmore') {
        textura = new THREE.TextureLoader().load('imagens/marmore.png'); // Substituir pelo caminho real da imagem
      } else if (tipo === 'madeira-cinza') {
        textura = new THREE.TextureLoader().load('imagens/madeira-cinza.png'); // Substituir pelo caminho real da imagem
      } else if (tipo === 'flutuante-castanho-claro') {
        textura = new THREE.TextureLoader().load('imagens/chao-flutuante-castanho-claro.png'); // Substituir pelo caminho real da imagem
      } else if (tipo === 'flutuante-castanho-escuro') {
        textura = new THREE.TextureLoader().load('imagens/chao-flutuante-castanho-escuro.png'); // Substituir pelo caminho real da imagem
      } else if (tipo === 'ceramica') {
        textura = new THREE.TextureLoader().load('imagens/ceramica.png'); // Substituir pelo caminho real da imagem
      }

      chao.material = new THREE.MeshBasicMaterial({ map: textura });
    }

    // Pintar paredes
    document.getElementById('colorPicker').addEventListener('input', (e) => {
      const cor = new THREE.Color(e.target.value);
      const paredeSelecionada = document.getElementById('wallSelector').value;

      if (paredeSelecionada === 'frente') {
        paredeFrente.material.color = cor;
      } else if (paredeSelecionada === 'esquerda') {
        paredeEsquerda.material.color = cor;
      } else if (paredeSelecionada === 'direita') {
        paredeDireita.material.color = cor;
      }
    });

    // Alterar o tipo de chão
    document.getElementById('floorSelector').addEventListener('change', (e) => {
      const tipoChao = e.target.value;
      mudarTexturaChao(tipoChao);
    });

    // Renderização
    function animar() {
      requestAnimationFrame(animar);
      renderer.render(scene, camera);
    }
    animar();
  </script>
</body>
</html>

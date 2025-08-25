<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Condomínios em Jogos</title>
  <style>
    /* Tela de carregamento */
    #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      background: #ffffff; /* cor de fundo da tela de loading */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 1s ease;
    }

    /* animação de carregamento */
    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg);}
      100% { transform: rotate(360deg);}
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Banner de cookies */
    .cookie-banner {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background: #111827cc;
      backdrop-filter: blur(8px);
      color: #f8fafc;
      padding: 16px;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 12px;
      align-items: center;
      z-index: 9999;
      border-top: 1px solid #334155;
      transform: translateY(100%);
      transition: transform 0.5s ease;
    }
    .cookie-wrap {display:flex; justify-content:space-between; align-items:center; width:100%;}
    .cookie-actions {display:flex; gap:8px;}
    .btn {cursor:pointer; padding:10px 14px; border-radius:8px; border:none; font-weight:600;}
    .btn-primary {background:#22c55e; color:#2c2c2c;}

    /* Mostrar banner */
    .cookie-banner.show {transform: translateY(0);}

    /* Modal de cookies */
    .modal {position:fixed; inset:0; display:none; place-items:center; z-index:10000;}
    .modal[open] {display:grid;}
    .modal-card {background:#0b1227; color: #ffffff; padding:16px; border-radius:16px; width:min(680px, 90%);}
    .modal-header, .modal-footer {display:flex; justify-content:space-between; align-items:center; padding:8px;}
    .modal-body {padding:8px 0;}
    .pref {display:flex; align-items:flex-start; gap:12px; padding:12px 0; border-bottom:1px dashed #334155;}
    .pref:last-child {border-bottom:none;}
    .switch {position:relative; width:44px; height:24px;}
    .switch input {opacity:0; width:0; height:0;}
    .slider {position:absolute; inset:0; cursor:pointer; background:#1f2a48; border-radius:999px; transition:.2s;}
    .slider:before {content:''; position:absolute; width:18px; height:18px; top:3px; left:3px; background:#fff; border-radius:50%; transition:.2s;}
    .switch input:checked + .slider {background:#22c55e;}
    .switch input:checked + .slider:before {transform:translateX(20px);}

    /* title */
    .title {
      height: 600px;
      background: linear-gradient(120deg, #ffffff, #29ccf5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      margin-top: 100px;
    }
    .title::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url("CondominiosEmJogosLogoPNG.png") no-repeat center center;
      background-size: 400px;
      opacity: 0.15;
      z-index: 0;
    }
    .title h1 {
      font-size: 32px;
      color: #0b4c61;
      background: #ffffff;
      padding: 10px 20px;
      border-radius: 10px;
      position: relative;
      z-index: 1;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Header */
    header {
      width: 100%;
      padding: 20px;
      display: flex;
      align-items: center;
      background: #ffffff;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 10;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    header h1 {
      margin-right: 50px; 
      color: #0b4c61;
    }
    .nav-buttons {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-left: auto; /* empurra os itens para a direita do header */
        padding: 0px 80px
     }
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
    }
    .btn-login {
      display: inline-block; 
      background-color: #29ccf5; 
      color: #fff; 
      padding:10px 20px; 
      border-radius:8px; 
      font-size:16px; 
      font-weight:bold; 
      text-decoration:none; 
      transition:0.3s;
    }
    .btn-login:hover {
      background: #6471fcff;
    }
    .btn-instagram {
      display:inline-block; 
      background-color: #515bd4; 
      color:#fff; 
      padding:10px 20px; 
      border-radius:8px; 
      font-size:16px; 
      font-weight:bold; 
      text-decoration:none; 
      transition:0.3s;
    }
    .btn-instagram:hover {
      background-color: #c7cbebff;
    }

    /* Seções */
    .content-section-proxjogos {
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2); 
      padding:100px 20px; 
      text-align:center;
    }
    /* Seções */
    .content-section-proxjogos {
        background: #ffffff; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.2); 
        padding:100px 20px; 
        text-align:center;
    }
    .content-section-noticias {
        background: #ffffff; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.2); 
        padding:50px 20px; 
        text-align:center;
    }
    .content-section-patrocinadores {
        background: #ffffff; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.2); 
        padding:50px 20px; 
        text-align:center;
    }
    .content-section h2 {
        font-size:26px; 
        color:#0b4c61; 
        margin-bottom:20px;
    }
    .content-section h5 {
        max-width:800px; 
        margin:auto; 
        font-size:16px; 
        color:#333;
    }
    </style>
</head>
<body>
  <!-- Tela de carregamento -->
  <div id="loading">
    <div class="spinner"></div>
  </div>

  <!-- Cabeçalho -->
  <header>
    <h1>Condomínios em Jogos</h1>
    <div class="nav-buttons">
      <a href="https://www.instagram.com/condominiosemjogos" target="_blank" class="btn btn-instagram">Instagram</a>
      <a href="login.php" class="btn btn-login">Login</a>
    </div>
  </header>

  <!-- Title -->
  <section class="title">
    <h1>BEM-VINDO AO MAIOR CAMPEONATO <br> DE LONDRINA!</h1>
  </section>

  <!-- Próximos Jogos -->
  <section class="content-section-proxjogos">
    <h2>Próximos Jogos</h2>
    <h5>Aqui você poderá acompanhar a tabela com os próximos jogos do campeonato.</h5>
  </section>

  <!-- Últimas Notícias -->
  <section class="content-section-noticias">
    <h2>Últimas Notícias</h2>
    <h5>Fique por dentro das novidades, resultados e destaques do torneio.</h5>
  </section>

  <!-- Patrocinadores -->
  <section class="content-section-patrocinadores">
    <h2>Patrocinadores</h2>
    <h5>Conheça os patrocinadores que apoiam este grande campeonato.</h5>
  </section>

  <!-- Banner de Cookies -->
  <section id="cookie-banner" class="cookie-banner" role="region" aria-label="Aviso de cookies" hidden>
    <div class="cookie-wrap">
      <div>
        <p class="cookie-title">Usamos cookies para melhorar sua experiência</p>
        <p class="cookie-desc">Alguns são necessários para o site funcionar. Você pode aceitar todos, rejeitar ou personalizar.</p>
      </div>
      <div class="cookie-actions">
        <button class="btn" id="btn-reject">Rejeitar</button>
        <button class="btn" id="btn-customize">Personalizar</button>
        <button class="btn btn-primary" id="btn-accept">Aceitar todos</button>
      </div>
    </div>
  </section>

  <!-- Modal de Preferências -->
  <dialog id="cookie-modal" class="modal" aria-labelledby="modal-title" aria-modal="true">
    <div class="modal-card" role="document">
      <div class="modal-header">
        <h2 id="modal-title" class="modal-title">Preferências de Cookies</h2>
        <button class="btn" id="btn-close-prefs" aria-label="Fechar">X</button>
      </div>
      <div class="modal-body">
        <div class="pref">
          <label class="switch" title="Obrigatório">
            <input type="checkbox" checked disabled />
            <span class="slider"></span>
          </label>
          <div>
            <h4>Necessários</h4>
            <p>Essenciais para funcionalidades básicas (ex.: login, carrinho, segurança).</p>
          </div>
        </div>
        <div class="pref">
          <label class="switch">
            <input id="toggle-analytics" type="checkbox" />
            <span class="slider"></span>
          </label>
          <div>
            <h4>Analíticos</h4>
            <p>Nos ajudam a entender como o site é usado para melhorar a experiência.</p>
          </div>
        </div>
        <div class="pref">
          <label class="switch">
            <input id="toggle-marketing" type="checkbox" />
            <span class="slider"></span>
          </label>
          <div>
            <h4>Marketing</h4>
            <p>Usados para personalização e ofertas relevantes.</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" id="btn-save-prefs">Salvar preferências</button>
      </div>
    </div>
  </dialog>

  <!-- JS de Cookies com animação -->
  <script>
    // Quando a página carregar completamente
    window.addEventListener("load", function() {
      const loading = document.getElementById("loading");
      const mainContent = document.getElementById("main-content");

      // Desaparece a tela de loading
      loading.style.opacity = 0;
      setTimeout(() => {
        loading.style.display = "none";
        mainContent.style.display = "block";
      }, 1000); // tempo igual ao transition
    });

    document.addEventListener('DOMContentLoaded', () => {
      function setCookie(name,value,days){
        const d=new Date();
        d.setTime(d.getTime()+(days*24*60*60*1000));
        document.cookie=name+"="+encodeURIComponent(value)+";expires="+d.toUTCString()+";path=/";
      }

      function getCookie(name){
        return document.cookie.split('; ').reduce((r,c)=>{
          const t=c.split('=');
          return t[0]===name?decodeURIComponent(t[1]):r
        }, null);
      }

      const CONSENT_COOKIE='cookie_consent';
      const banner=document.getElementById('cookie-banner');
      const modal=document.getElementById('cookie-modal');
      const analytics=document.getElementById('toggle-analytics');
      const marketing=document.getElementById('toggle-marketing');

      function showBanner(){
        banner.hidden = false;
        setTimeout(()=>banner.classList.add('show'), 10); // força animação
      }

      function hideBanner(){
        banner.classList.remove('show');
        setTimeout(()=>{banner.hidden = true;}, 500); // espera animação
      }

      function openModal(){modal.setAttribute('open','');}
      function closeModal(){modal.removeAttribute('open');}
      function applyConsent(c){console.log('Consentimento aplicado:',c);}

      function saveConsent(c){
        setCookie(CONSENT_COOKIE,JSON.stringify(c),180);
        applyConsent(c);
      }

      function readConsent(){
        try{ return JSON.parse(getCookie(CONSENT_COOKIE)||'null') }
        catch{return null}
      }

      // Event listeners
      document.getElementById('btn-accept').addEventListener('click', ()=>{
        saveConsent({necessary:true,analytics:true,marketing:true});
        hideBanner();
      });
      document.getElementById('btn-reject').addEventListener('click', ()=>{
        saveConsent({necessary:true,analytics:false,marketing:false});
        hideBanner();
      });
      document.getElementById('btn-customize').addEventListener('click', ()=>{openModal();});
      document.getElementById('btn-close-prefs').addEventListener('click', ()=>{closeModal();});
      document.getElementById('btn-save-prefs').addEventListener('click', ()=>{
        saveConsent({necessary:true,analytics:analytics.checked,marketing:marketing.checked});
        closeModal();
        hideBanner();
      });

      // Mostrar banner se não há consentimento salvo
      const c = readConsent();
      if(!c){ showBanner(); }
      else {
        analytics.checked=!!c.analytics;
        marketing.checked=!!c.marketing;
        applyConsent(c);
      }
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página de Inicio Personalizada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --bg-color: #082f49;
            --text-color: #fff;
            --card-bg: #07283dff;
            --footer-bg: #222;
        }

        .light-mode {
            --bg-color: #eeece2;
            --text-color: #333;
            --card-bg: #fff;
            --footer-bg: #e0e0e0;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
            flex-direction: column;
            position: relative;
        }

        .logo h1 {
            margin: 0;
        }

        .header-right {
            position: absolute;
            right: 20px;
            top: 20px;
            display: flex;
            align-items: center;
        }

        .login-link {
            margin-right: 20px;
            color: var(--text-color);
            text-decoration: none;
            font-weight: bold;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid var(--text-color);
            border-radius: 10px;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            overflow: hidden;

        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .services {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 5px;
            flex: 1;
            margin-bottom: 20px;
        }

        .questions .card {
            margin-bottom: 20px;
        }

        .new-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .text-subsection, .image-subsection {
            flex: 1 1 calc(50% - 10px);
            min-width: 300px;
            text-align: center;
        }

        .image-subsection img {
            max-width: 100%;
            height: auto;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: var(--footer-bg);
        }

        .whatsapp-button {
            position: fixed;
            bottom: 10%;
            right: 20px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        @media only screen and (max-width: 768px) {
            .services {
                flex-direction: column;
            }
            
            .card {
                flex: 1 1 100%;
            }
            
            .text-subsection, .image-subsection {
                flex: 1 1 100%;
            }
        }
        .my-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 23px;
        cursor: pointer;
        height: 3rem;   
        width: 12rem;
        font-size: 20px;
        }

        .my-button:hover {
        background-color: #45a049;
        }

        .my-button:active {
        background-color: #3e8e41;
        }
        .video-containerr{
        text-align: center;
    }

    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
            <img alt="ChatPanel logo" src="http://127.0.0.1:8000/logo.svg" style="height: 2rem;" class="fi-logo flex mb-4">
            </div>
            <div class="title">
                <h1>Impulsa tu marketing con Chatbots Inteligentes de WhatsApp</h1>
                <h3>Crea chatbots para WhatsApp que te ayudarán a mejorar la atención al cliente, aumentar las ventas y hacer crecer tu negocio.</h3>

                
            </div>
            <div class="header-right">
                <a href="http://127.0.0.1:8000/admin/login" class="login-link">Login</a>
                <button class="theme-toggle" onclick="toggleTheme()">
                    <i class="fas fa-sun"></i>
                </button>
            </div>
        </header>
     
        <div class="section">
            <div class="video-containerr">
                <!-- <iframe src="https://cdn.pixabay.com/video/2015/10/27/1200-143842692_large.mp4" allowfullscreen></iframe> -->
                    <img src="http://127.0.0.1:8000/banner.png" alt="" style="display: block; margin: 0 auto; max-width: 85%;">
                    <a href="https://api.whatsapp.com/send?phone=573224243811"><button class="my-button">Quiero acceso</button></a>
                    <br>    
                </div>
            
        </div>
        <div class="section services">
            <div class="card">
                <h3><i class="fa-brands fa-whatsapp"></i> Crea tu Primer Chatbot de WhatsApp</h3>
                <p>Nuestra plataforma es fácil de usar y te permite crear chatbots de manera sencilla y rápida, facilitando la automatización de las conversaciones en tu negocio de manera eficiente y efectiva. Empieza hoy mismo y mejora la interacción con tus clientes.</p>
            </div>
            <div class="card">
                <h3><i class="fa-solid fa-brain"></i> Chatbots de WhatsApp Inteligentes</h3>
                <p>Desarrolla un agente de ventas innovador que no solo genere leads, sino que también convierta clientes de manera automática y constante. Con inteligencia artificial, tu chatbot aprenderá y mejorará con cada interacción, optimizando tus procesos.</p>
            </div>
            <div class="card">
                <h3><i class="fa-solid fa-square-poll-horizontal"></i> Campañas de Marketing Automatizadas</h3>
                <p>Si realizas campañas de marketing digital, confía la atención al cliente a tu chatbot con inteligencia artificial. Asegura una respuesta inmediata y personalizada, mejorando la experiencia del usuario y aumentando la eficiencia de tus campañas publicitarias.</p>
            </div>
        </div>

        <div class="section questions">
            <div class="card">
                <h3>📣 Personalización en la Interacción con Clientes</h3>
                <p>Los chatbots de WhatsApp y Telegram permiten una interacción personalizada con los clientes al utilizar datos previos para adaptar las respuestas y recomendaciones. Esta personalización aumenta la relevancia de las conversaciones y fortalece la conexión emocional entre la marca y el cliente, mejorando la lealtad y el compromiso.</p>
                </div>
            <div class="card">
                <h3>🌎 Escalabilidad y Alcance Global</h3>
                <p>Gracias a su naturaleza digital, los chatbots de WhatsApp y Telegram ofrecen una escalabilidad sin precedentes, lo que permite a las empresas ampliar su alcance de manera global. Pueden atender a miles de clientes simultáneamente, lo que resulta fundamental para empresas con audiencias diversificadas y en crecimiento.</p>
            </div>
            <div class="card">
                <h3>⚙️ Automatización Eficiente de Interacciones</h3>
                <p>Los chatbots de WhatsApp y Telegram ofrecen una automatización eficiente de interacciones, ahorrando tiempo y recursos al responder preguntas frecuentes y brindar asistencia instantánea. Esta capacidad mejora la satisfacción del cliente al proporcionar respuestas rápidas y precisas las 24 horas del día, los 7 días de la semana.</p>
            </div>
        </div>

        <div class="section new-section">
            <div class="text-subsection">
                <h1>¿Tiene Preguntas?</h1>
                <h3>¿Desea conocer más acerca de la creación y el funcionamiento de los chatbots de WhatsApp con inteligencia artificial? Estamos aquí para ayudarle a resolver cualquier duda.</h3>
                <h2>Póngase en Contacto Ahora Sin Compromiso</h2>
                <br>
                <a href="https://api.whatsapp.com/send?phone=573224243811"><button class="my-button">Contactame</button></a>                
            </div>
            <div class="image-subsection">
                <img src="http://127.0.0.1:8000/tecnochat.jpg" alt="Imagen de ejemplo" style="display: block; margin: 0 auto; max-width: 75%;">
            </div>
        </div>
    </div>

    <footer class="footer">
    <div class="logo">
            <img alt="ChatPanel logo" src="http://127.0.0.1:8000/logo.svg" style="height: 2rem;" class="fi-logo flex mb-4">
            </div>
        <!-- <a href="#">Acerca de nosotros</a> 
        <a href="#">Servicios</a> |
        <a href="#">Contáctanos</a> |
        <a href="#">Términos y Condiciones</a> -->
    </footer>

    <a href="https://wa.me/1234567890" target="_blank" class="whatsapp-button">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
            const themeIcon = document.querySelector('.theme-toggle i');
            themeIcon.classList.toggle('fa-sun');
            themeIcon.classList.toggle('fa-moon');
        }
    </script>
</body>
</html>
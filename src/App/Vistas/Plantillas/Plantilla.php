<?php

namespace App\Vistas\Plantillas;
use DateTime;

class Plantilla
{
    private string $encabezado;
    private string $nav;
    private string $bloquePresentacion;
    private string $bloqueDosColumnas;
    private string $bloqueTestimonio;
    private string $bloqueServicios;
    private string $bloquePrecios;
    private string $bloqueEmpleados;
    private string $body;
    private string $footer;

    /**
     * @return string
     */
    public function getEncabezado(): string
    {
        return $this->encabezado;
    }

    /**
     * @param string $encabezado
     */
    public function setEncabezado(string $encabezado): void
    {
        $this->encabezado = $encabezado;
    }

    /**
     * @return string
     */
    public function getNav(): string
    {
        return $this->nav;
    }

    /**
     * @param string $nav
     */
    public function setNav(string $nav): void
    {
        $this->nav = $nav;
    }

    /**
     * @return string
     */
    public function getBloquePresentacion(): string
    {
        return $this->bloquePresentacion;
    }

    /**
     * @param string $bloquePresentacion
     */
    public function setBloquePresentacion(string $bloquePresentacion): void
    {
        $this->bloquePresentacion = $bloquePresentacion;
    }

    /**
     * @return string
     */
    public function getBloqueDosColumnas(): string
    {
        return $this->bloqueDosColumnas;
    }

    /**
     * @param string $bloqueDosColumnas
     */
    public function setBloqueDosColumnas(string $bloqueDosColumnas): void
    {
        $this->bloqueDosColumnas = $bloqueDosColumnas;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     */
    public function setFooter(string $footer): void
    {
        $this->footer = $footer;
    }



    public function __construct(string $titulo="Sin titulo",string $dirLogotipo='/Vistas/Plantillas/assets/img/logo.png' ,
        array $menu=['Inicio'=>'/','Log-in'=>'login','Registro'=>'#'],
        $encabezadoPrincipal="Sin encabezado",$descripcionPrincipal="Sin descripción"){
        $this->generarEncabezadoHTML($titulo);
        $this->generarBarraNavegacionHTML($dirLogotipo,$menu);
        $this->generarPresentacionWeb($encabezadoPrincipal,$descripcionPrincipal);
        $this->generarFooter();
    }


    public function generarEncabezadoHTML($titulo): void
    {
        $this->setEncabezado("
                <!DOCTYPE html>
                <html xmlns='http://www.w3.org/1999/xhtml' lang='es'>
                <head>
                    <meta charset='utf-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
                    <meta name='description' content='' />
                    <meta name='author' content='' />
                    <title>$titulo</title>
                    <!-- BOOTSTRAP CORE STYLE CSS -->
                    <link href='/App/Vistas/Plantillas/assets/css/bootstrap.css' rel='stylesheet' />
                    <!-- FONT AWESOME CSS -->
                    <link href='/App/Vista/Plantillas/assets/css/font-awesome.min.css' rel='stylesheet' />
                     <!-- STYLE SWITCHER  CSS -->
                    <link href='/App/Vistas/Plantillas/assets/css/styleSwitcher.css' rel='stylesheet' />
                    <!-- CUSTOM STYLE CSS -->
                    <link href='/App/Vistas/Plantillas/assets/css/style.css' rel='stylesheet' />  
                     <!--GREEN STYLE VERSION IS BY DEFAULT, USE ANY ONE STYLESHEET FROM TWO STYLESHEETS (green or red) HERE-->
                     <link href='/App/Vistas/Plantillas/assets/css/themes/green.css' id='mainCSS' rel='stylesheet' />   
                  <!-- Google	Fonts -->
                    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
                </head>
                <body>
    ");
    }
    public function generarBarraNavegacionHTML(string $dirLogotipo,array $opcionesMenu):void{
        $this->nav="
            <div class='navbar navbar-inverse navbar-fixed-top move-me' id='menu'>
            <div class='container'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand' href='/'><img class='logo-custom' src='$dirLogotipo' alt='logotipo empresa'  /></a>
                </div>
                <div class='navbar-collapse collapse'>
                    <ul class='nav navbar-nav navbar-right'>";

        foreach ($opcionesMenu as $texto => $enlace){
            $this->nav.= "<li><a href='$enlace'>$texto</a></li>";
        }

        $this->nav.="  <li><a href='mailto:info@cobrapadel.es?Subject=Contacto' target='_top'> <i class='fa fa-envelope-o'></i><span class='home-mail'>e-mail: info@cobrapadel.es</span></a></li>
                    </ul>
                </div>
            </div>
        </div>";
    }

    public function generarPresentacionWeb(string $tituloPrincipal, string $descripcion):void{
        $this->bloquePresentacion="
            <section class='header-sec' id='home' >
               <div class='overlay'>
                <div class='container'>
               <div class='row text-center' >
               
                   <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                   
                    <h2 data-scroll-reveal='enter from the bottom after 0.1s'>
                        <strong>";
        $this->bloquePresentacion.=$tituloPrincipal;
        $this->bloquePresentacion.="               
                            </strong>
                            </h2>
                      <h3 data-scroll-reveal='enter from the bottom after 0.8s'>";
        $this->bloquePresentacion.= $descripcion;
        $this->bloquePresentacion.="</h3>       
                      <br />
                </div>
                   </div>
                    </div>
               </div>
           </section>";
    }

    public function generarServicios():void{
        $this->bloqueServicios="
        
        <section class='features' id='features'>
            <div class='container'>
                <div class='row text-center' >
                    <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                        <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                        <strong>Nuestros Servicios</strong>
                        </h3>
                    </div>
                </div>
            <div class='row ' >
                <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the left after 0.4s' >
                    <div class='media'>
                        <div class='pull-left'>
                            <i class='fa fa-trophy fa-5x' aria-hidden='true'></i>
                        </div>
                        <div class='media-body'>
                            <h4 class='media-heading'><strong> Pistas de Campeonato </strong></h4>
                            <p>Todas nuestras pistas tienen certificación WPT. Siente el poder de entrenar
                            como un profesional, olvida las lesiones y céntrate en mejorar tu juego.
                            </p>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the right after 0.7s'>
                    <div class='media'>
                        <div class='pull-left'>
                            <i class='fa fa-medkit fa-5x' aria-hidden='true'></i>
                        </div>
                        <div class='media-body'>
                            <h4 class='media-heading'><strong> Cuidamos de ti </strong></h4>
                            <p>
                            Tenemos servicios de entrenamiento y fisioterapia especialmente diseñados para ti. Todo 
                            lo que necesites para llegar al olimpo del WPT.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        ";
    }

    public function generarPrecios():void{
        $this->bloquePrecios = "
            <section class='price-sec text-center '  id='pricing'>
                <div class='col-lg-6  col-md-6 col-sm-6 single-price' data-scroll-reveal='enter from the left after 0.2s'>
                    <span >2,50 <i class='fa fa-user' aria-hidden='true'></i></span>
                        <h1>PISTA INDIVIDUALES</h1>
                </div>
                <div class='col-lg-6  col-md-6 col-sm-6 multi-price' data-scroll-reveal='enter from the right after 0.2s'>
                    <span >5,50 <i class='fa fa-users' aria-hidden='true'></i></span>
                        <h1>PISTA DOBLES</h1>
                    </div>
            </section>     
        ";


    }

    public function generarTestimonio():void
    {
        $this->bloqueTestimonio="
            <section class='testi-sec' >
                <div class='overlay'>
                    <div class='container'>
                        <div class='row text-center' >
                            <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                                <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                                    <strong>Nuestros Valores</strong>
                                </h3>
                                <h4 data-scroll-reveal='enter from the bottom after 0.8s'>
                                    <i class='fa fa-quote-left '></i> 
                                    Nunca es solo pádel con Nostros. Tenemos todo lo necesario para que te sientas como en casa.
                            Avanza con nostros para conseguir tus objetivos en la práctica de nuestro deporte favorito.
                                    <i class='fa fa-quote-right '></i>
                                    <br />
                                    <span class='pull-right'><strong>Miguel A. Tomas</strong></span>
                                </h4>
                                <h6 data-scroll-reveal='enter from the bottom after 1.0s'>
                                    <br />
                                    <br />
                                    <span class='pull-right'><strong>CEO de CobraPadel</strong></span>
                                    <br />
                                    <br />
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
          </section>
        ";

    }

    public function generarEmpleados():void{

        $this->bloqueEmpleados="
        
            <section class='developers' id='developers' >
                <div class='container'>
                    <div class='row text-center' >
                        <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                            <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                                <strong>Nuestro Equipo</strong>
                            </h3>
                        </div>
                    </div>
                    <div class='row ' >
                        <div class='col-lg-4 col-md-4 col-sm-4' data-scroll-reveal='enter from the left after 0.2s' >
                            <img src='/App/Vistas/Plantillas/assets/img/1.jpg' class='img-rounded img-responsive' alt=''  />
                            <h4 ><strong> Carla Garcia </strong></h4>
                            <i>Directora de Salud</i>
                            <p>Especialista en preparación deportiva. Licenciada en Fisioterapia por la Universidad de Deusto</p>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4' data-scroll-reveal='enter from the bottom after 0.4s' >
                            <img src='/App/Vistas/Plantillas/assets/img/2.jpg' class='img-rounded img-responsive' alt=''  />
                            <h4 ><strong>Gema Hernandez</strong></h4>
                            <i>Vicedirectora de Operaciones</i>
                            <p>Mandamás de la empresa. Estamos aquí para que tu progresión no pare</p>
                        </div>
                        <div class='col-lg-4 col-md-4 col-sm-4' data-scroll-reveal='enter from the right after 0.2s' >
                            <img src='/App/Vistas/Plantillas/assets/img/3.jpg' class='img-rounded img-responsive' alt=''  />
                            <h4 ><strong> Carlos Gómez </strong></h4>
                            <i>Director de Desarrollo</i>
                            <p>Padelista profesional desde los 18 años. Licenciado en INEF por la Universidad de Alicante</p>
                        </div>
                    </div>
                </div>
            </section>
        ";


    }


    public function generarDosColumnasConFondoBlanco (string $tituloSeccion,string $celdaIzquierda,string $celdaDerecha):void{

        $this->bloqueDosColumnas="
            <section class='contact' id='contact' >
                <div class='container'>
                   <div class='row text-center ' >
                      <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                        <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                        <strong>";
        $this->bloqueDosColumnas.= $tituloSeccion;
        $this->bloqueDosColumnas.="</strong>
                  </h3>
                 </div>
                 </div>
                <div class='row'>
                     <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the right after 0.2s'>";
        $this->bloqueDosColumnas.=$celdaIzquierda;
        $this->bloqueDosColumnas.="
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the left after 0.4s'>";
        $this->bloqueDosColumnas.=$celdaDerecha;
        $this->bloqueDosColumnas.="</div>
                </div>
                </div>
              </section>
        ";
    }



    public function generarFooter():void{
        $anyo= new DateTime();
        $this->footer="
        <section class='contact' id='contact' >
            <div class='container'>
                <div class='row text-center ' >
                   <div class='col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1'>
                        <h3 data-scroll-reveal='enter from the bottom after 0.1s'>
                            <strong>Ven a vistarnos</strong>
                        </h3>
                    </div>
                </div>
            <div class='row'>
                <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the right after 0.2s'>
                    <strong>DIRECCIÓN :</strong>
                     <p>Reina Sofia, 20<br />
                        03610 - Petrer (Alicante)<br />
                        email: info@cabrapadel.com</p>
                </div>
                <div class='col-lg-6 col-md-6 col-sm-6' data-scroll-reveal='enter from the left after 0.4s'>
                    <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3123.361966229378!2d-0.7815033845418508!3d38.47928887908522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd63c52dcc953db9%3A0x157a37c112acbc6a!2sI.E.S.%20Poeta%20Paco%20Moll%C3%A0!5e0!3m2!1ses!2ses!4v1668718013355!5m2!1ses!2ses' width='600' height='200' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>
                </div>
            </div>
            
            </div>
          </section>
          <div class='myfooter' >
                     &copy; ".$anyo->format('Y')." cobrapadel.com | Theme by: <a href='https://binarytheme.com' style='color:#fff;' target='_blank'  >www.binarytheme.com</a>
          </div>
        
            <!--  Jquery Core Script -->
            <script src='/App/Vista/Plantilla/assets/js/jquery-1.10.2.js'></script>
            <!--  Core Bootstrap Script -->
            <script src='/App/Vista/Plantilla/assets/js/bootstrap.js'></script>
             <!--  Scrolling Reveal Script -->
            <script src='/App/Vista/Plantilla/assets/js/scrollReveal.js'></script>
            <!--  Scroll Scripts --> 
            <script src='/App/Vista/Plantilla/assets/js/jquery.easing.min.js'></script>
             <!--  Style Switcher Scripts -->
            <script src='/App/Vista/Plantilla/assets/js/styleSwitcher.js'></script>
                <!--  Custom Scripts -->    
            <script src='/App/Vista/Plantilla/assets/js/custom.js'></script>
            </body>
            </html>";

    }
    public function generarWebCompleta():string{


        $vista = $this->getEncabezado();
        $vista .= $this->getNav();
        $vista .= $this->getBloquePresentacion();
        if (isset($this->body)){
            $vista .= $this->getBody();
        }
        if (isset($this->bloqueDosColumnas)){
            $vista.= $this->getBloqueDosColumnas();
        }
        if (isset($this->bloqueServicios)){
            $vista.= $this->bloqueServicios;
        }
        if (isset($this->bloqueTestimonio)){
            $vista.=$this->bloqueTestimonio;
        }
        if (isset($this->bloqueEmpleados)){
            $vista.=$this->bloqueEmpleados;
        }
        if (isset($this->bloquePrecios)){
            $vista.=$this->bloquePrecios;
        }
        $vista .= $this->getFooter();

        return $vista;
    }
}
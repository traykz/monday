<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Laravel\Dusk\Chrome;
use PHPUnit\Framework\Assert as PHPUnit;


class DattTest extends DuskTestCase
{

use DatabaseMigrations;
 
 protected $user;

 /**
     * Clase para realizar testing a campañas
     *
     * @return void
     */

public function testNav()
    {
       

try {
    $this->browse(function (Browser $browser) {                        
        
        $url = 'https://myweeklyadvice.com/energix/discount/us/?track=false';
        $name = '';
        $value = '';        
        $pageSubmitBtn = 'a[class="tracking-link btn save-now"]'; 
        
       
        $response = $this->get('http://www.myweeklyadvice.com');
        $response->assertStatus(200);



       $browser->visit($url);    


              
                    if(empty($name) and empty($value)){
                        dump('No ingresaste valores para buscar Cookies'); 
                    }else{
                        dump('El valor de la cookie del website '.$name.' es '.$browser->plainCookie($name).'');
                        dump('El valor que buscas para la cookie '.$name.' es '.$value.'');
                        $browser->assertPlainCookieValue($name, $value);
                        dump($browser->plainCookie($name));        
                    }

                    dump('Navegacion Correcta PRESALE...');

                    $anchorLinks = $browser->script(" 
                            elementos = [];
                            var a = document.getElementsByTagName('a');
                            for (var idx= 0; idx < a.length; ++idx){
                            elementos.push(a[idx].href);
                        }
                            return elementos;
                        ");

                       dump('Elementos Anchor con Links del PRESALE');
                      
                       dump($anchorLinks);
                       $imgLinks = $browser->script(" 
                       elementos = [];
                       var a = document.getElementsByTagName('img');
                       for (var idx= 0; idx < a.length; ++idx){
                       elementos.push(a[idx].src);
                        }
                       return elementos;
                      ");                   
                      dump('Elementos IMG con Links del PRESALE');
                      dump($imgLinks);    

        
        $browser->click($pageSubmitBtn)->waitForReload(function() use ($browser){
                     /*Agregar en el TPL si es Offer O Chekout*/
                      dump('Navegacion Correcta...Revisando Links');
                     
                     
                      $anchorLinks = $browser->script(" 
                            elementos = [];
                            var a = document.getElementsByTagName('a');
                            for (var idx= 0; idx < a.length; ++idx){
                            elementos.push(a[idx].href);
                        }
                            return elementos;            
                        ");  
                        
                               dump('Elementos Anchor con Links');
                               dump($anchorLinks);
                        
                       $imgLinks = $browser->script(" 
                       elementos = [];
                       var a = document.getElementsByTagName('img');
                         for (var idx= 0; idx < a.length; ++idx){
                                elementos.push(a[idx].src);
                              }
                              return elementos;");

                      dump('Elementos IMG con Links');
                      dump($imgLinks);       
                      
                      dump($browser->assertSee('s2'));


                      
                    }, 3);
                    




                    //$variable = $browser->assertQueryStringHas('s2');
                    
                    $browser->pause(10000);       

                
            
            }); 
            
            /* End of TRY Condition*/



    } catch (\Exception $e) {
     
       dump($e->getMessage());

   
    }




    }
  

     
     /* $js = $browser->script("                
        function getAllElementsWithAttribute(attribute){
        var matchingElements = [];
        var allElements = document.getElementsByTagName('a');
        for (var i = 0, n = allElements.length; i < n; i++){
        if (allElements[i].getAttribute(attribute) !== null)
        {
        // Element exists with attribute. Add to array.
        matchingElements.push(allElements[i]);
        }
        }
        return matchingElements;
        }
        return getAllElementsWithAttribute('href');
       ");*/

       // $browser->visit('');    crear nueva vista

/* Dispara Google Tag Para realizar conversion */
                         /* $imgLinks = $browser->script("   (function(w, d, s, l, i) {
                                                                w[l] = w[l] || [];
                                                                w[l].push({
                                                                    'gtm.start': new Date().getTime(),
                                                                    event: 'gtm.js'
                                                                });
                                                                var f = d.getElementsByTagName(s)[0],
                                                                    j = d.createElement(s),
                                                                    dl = l != 'dataLayer' ? '&l=' + l : '';
                                                                j.async = true;
                                                                j.src =
                                                                 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                                                                f.parentNode.insertBefore(j, f);
                                                        })(window, document, 'script', 'dataLayer', 'GTM-K5WGJBG');  "); 
 */
                      

                // use press is for buttons

                // return $browser->script("return window.location.protocol == 'https:';");












}


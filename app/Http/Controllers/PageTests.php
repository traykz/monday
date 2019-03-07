<?php

namespace App\Http\Controllers;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;
use Illuminate\Http\Request;


/*added*/
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use PHPUnit\Framework\Assert as PHPUnit;

class PageTests extends Controller
{
    


public function CheckAlive(){


            $response = function(Browser $browser){
            
            

            $response->get('http://www.myweeklyadvice.com');    
            $response->assertStatus(200);

             

            
        };

        print_r($response);

}




public function testUno(){

    
        $process = (new ChromeProcess)->toProcess();
        
        $process->start();
        
        $options = (new ChromeOptions)->addArguments(['--disable-gpu']);
        
        $capabilities = DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options);
        
        $driver = retry(5, function () use($capabilities) {
            return RemoteWebDriver::create('http://localhost:9515', $capabilities);
        }, 50);
        
        $browser = new Browser($driver);
        
        $browser->visit('https://www.google.com');
        
        $browser->quit();
        
        $process->stop();



}






}

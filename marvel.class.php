<?php
require 'vendor/autoload.php';

class Marvel{
    const PRIVATE_KEY = 'a8f28a99f9c1e47453bf42c65d08a69ea6303652';
    const PUBLIC_KEY = '002ed2d3ed5ee298b551bdfcd7eed17e';
    private $ts;
    private $hash;
    private $nome;
    private $cards;

    public function __construct(){
        $this->setTs();
        $this->setHash();
        $this->setNome();
        $this->buscarDados();
    }
    
    public function getTs(){
       return $this->ts;
   }

   private function setTs(){
       $this->ts = time();
   }
   
   public function getNome(){
       return $this->nome;
   }
   
   private function setNome(){
       if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['txtNome'])){
             $this->nome = $_POST['txtNome'];
            }else{
             $this->nome = 'spider-man';
            }
       }else{
             $this->nome = 'spider-man';
       }
   }
   
   public function getCards(){
       return $this->cards;
   }
   
   private function setCards($cards){
       $this->cards = $cards;
   }
   
   public function getHash(){
       return $this->hash;
   }
   
   private function setHash(){
       $this->hash = md5($this->getTs(). self::PRIVATE_KEY.self::PUBLIC_KEY);
   }
   
   private function buscarDados(){
       // Executa a requisição, obtendo a resposta
        $response = Unirest\Request::get('https://gateway.marvel.com/v1/public/characters?apikey='.self::PUBLIC_KEY.'&nameStartsWith='.$this->getNome().'&hash='.$this->getHash().'&ts='.$this->getTs());
        
        
       $status = $teste = (array)$response->body;
       if($status['code'] == '409'){
           $this->setCards('Nenhum resultado encontrado');
       }else{
            //Monta o layout
            $this->exibirDados($response->body->data->results);
       }               
        
   }
    
   private function exibirDados($results){
       
        $cards = '';
        
        foreach($results as $i=>$obj){

            $obj = (array)$obj;

            $cards .= '<!-- Modal -->
                        <div class="modal fade" id="modal_'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img class="card-img-top" src="'.$obj['thumbnail']->path.'.'.$obj['thumbnail']->extension.'" alt="">
                              </div>

                            </div>
                          </div>
                        </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                            <div class="card h-100">
                              <a href="#" data-toggle="modal" data-target="#modal_'.$i.'"><img class="card-img-top" src="'.$obj['thumbnail']->path.'.'.$obj['thumbnail']->extension.'" alt=""></a>
                              <div class="card-body">
                                <h4 class="card-title">
                                  <a href="#">'.$obj['name'].'</a>
                                </h4>
                                <p class="card-text">'.$obj['description'].'</p>'
                        . '<h6><b>Séries:</b></h6>'
                        . '<ul>';

            foreach ($obj['series']->items as $series){

                $cards .= '<li>'.$series->name.'</li>';

            }

            $cards .= '</ul>
                    </div>
                      </div>
                    </div>';
        }

         $this->setCards($cards);

   }
   
}

?>
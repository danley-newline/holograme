<?php

namespace Drupal\headless_vue\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\Request;

class HeadlessVueController extends ControllerBase{


    // /**
    //  * Display the markup.
    //  *
    //  * @return array
    //  *   Return markup array.
    //  */
    public function contentPage(){
        return [
            '#type' => 'markup',
            '#markup' => $this->t('<div id="app"></div>'),
            '#attached' => [
                'library' => [
                  'headless_vue/headless_vue'
                ]
              ]
        ];
    }

    public function renderApi(){
      return new JsonResponse(
        [
          "data" => $this->getResults(),
          "methods" => "GET",
        ]
      );
    }

    private function getResults(){
      return[
          [
              "title"=> "The Shawshank Redemption",
              "rank"=> "1",
              "id"=> "tt0111161"
          ],
          [
              "title"=> "The Godfather",
              "rank"=> "2",
              "id"=> "tt0068646"
          ],
          [
              "title"=> "The Godfather=> Part II",
              "rank"=> "3",
              "id"=> "tt0071562"
          ],
          [
              "title"=> "Pulp Fiction",
              "rank"=> "4",
              "id"=> "tt0110912"
          ],
          [
              "title"=> "The Good, the Bad and the Ugly",
              "rank"=> "5",
              "id"=> "tt0060196"
          ],
          [
              "title"=> "The Dark Knight",
              "rank"=> "6",
              "id"=> "tt0468569"
          ],
          [
              "title"=> "12 Angry Men",
              "rank"=> "7",
              "id"=> "tt0050083"
          ],
          [
              "title"=> "Schindler's List",
              "rank"=> "8",
              "id"=> "tt0108052"
          ],
          [
              "title"=> "The Lord of the Rings=> The Return of the King",
              "rank"=> "9",
              "id"=> "tt0167260"
          ],
          [
              "title"=> "Fight Club",
              "rank"=> "10",
              "id"=> "tt0137523"
          ],
          [
              "title"=> "Star Wars=> Episode V - The Empire Strikes Back",
              "rank"=> "11",
              "id"=> "tt0080684"
          ],
          [
              "title"=> "The Lord of the Rings=> The Fellowship of the Ring",
              "rank"=> "12",
              "id"=> "tt0120737"
          ],
          
          [
              "title"=> "Seven Samurai",
              "rank"=> "17",
              "id"=> "tt0047478"
          ],
          [
              "title"=> "Forrest Gump",
              "rank"=> "18",
              "id"=> "tt0109830"
          ],
          [
              "title"=> "The Matrix",
              "rank"=> "19",
              "id"=> "tt0133093"
          ],
          [
              "title"=> "The Lord of the Rings=> The Two Towers",
              "rank"=> "20",
              "id"=> "tt0167261"
          ],
          [
              "title"=> "City of God",
              "rank"=> "21",
              "id"=> "tt0317248"
          ],
          [
              "title"=> "Se7en",
              "rank"=> "22",
              "id"=> "tt0114369"
          ],
          [
              "title"=> "The Silence of the Lambs",
              "rank"=> "23",
              "id"=> "tt0102926"
          ],
          
        
      ];
    }

    public function getDataUser() {
      //get the configuration
      $config = \Drupal::config('headless_vue.settings');
      //get the stored name or return default
      $name = $config->get('name') ? : 'no name stored yet';
      $email = $config->get('email') ? : 'no email stored yet';
      $body = $config->get('body') ? : 'no body stored yet';

      //return the response
      $res['name'] = $name;
      $res['body'] = $body;
      $res['email'] = $email;
      return new JsonResponse($res);
  }


    public function postDataUser(Request $req) {
      //decode the json data
      $data = Json::decode($req->getContent());
      //check if the name property is present or not
      if ( !isset($data['name']) && !isset($data['body']) && !isset($data['email'])){
          //return the error response
          $res['error_code'] = 404;
          $res['error_msg'] = 'name or body or email property is missing, cannot store the configuration';
      } else {
          //if the name property is present in the json data, store in a drupal configuration
          $config = \Drupal::service('config.factory')->getEditable('headless_vue.settings');
          $config->set('name', $data['name'])->save();
          $config->set('body', $data['body'])->save();
          $config->set('email', $data['email'])->save();
          //return the success response
          $res['result'] = 'Hello '.$data['name'].'! You name stored successfully!';
      }
      return new JsonResponse($res);
  }

}
<?php
namespace App\Controllers;

use App\Models\Client;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Editor;
use App\Models\Rent;
use App\Models\RentHasBook;


use App\Providers\View;
use App\Providers\Validator;



class ClientController{
    
    public function index(){        
        $book = new Book;
        $category = new Category;
        $author = new Author;
        $editor = new Editor;
        
        $select = $book->select();
        
        // Injecter les données de $livres dans db        
       if(count($select) === 0){  
           
          // Lire le contenu du fichier JSON
           $json = file_get_contents('./data/livres.json');

            // Convertir le JSON en tableau associatif PHP
            $livres = json_decode($json, true);
            $i = 1;         
            foreach ($livres as $livre) { 
                            
                $dataCategory = ["nom" => $livre['categorie']];
                $category->insert($dataCategory);  
             
                $dataAuthor = ["nom" => $livre['auteur']];                
                $author->insert($dataAuthor);                
                
                $dataEditor = ["nom" => $livre['editeur']]; 
                $editor->insert($dataEditor);
               
                $dataLivres = ['titre' => $livre['titre'], 
                               'description' => $livre['description'],
                               'pages' => $livre['pages'],
                               'image' => $livre['image'],
                               'auteur_id' => $i,
                               'categorie_id' => $i,
                               'editeur_id' => $i]; 
                              
                $book->insert($dataLivres);       
                $i++;            
             }    
        }
        return View::render("client/index", ['books' => $select]);     
    }

    public function order($get = []){        
        $book = new Book;
        $client = new Client;
        $nom = $client->selectValueId('nom', 'id', $get['id'])['nom'];
        $select = $book->select();
        return View::render("client/order", ['nom' => $nom, 'id' => $get['id'], 'books' => $select]);
    }

   

    public function basket($data = []){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        $book = new Book();   
        $bookId = $book->selectValueId('id', 'titre', $data['titre'])['id'];
        return View::redirect('client/show?id='.$data['id'].'&bookId='.$bookId);
    }

    public function selectBooks($ids, $rentBookInst, $bookInst){
        $livresSelect = [];
        $livreIds = [];       
        foreach($ids as $key=>$id){
            $rentIds = [$key => $id['id']];
            $livreIds[] = $rentBookInst->selectAll($id['id'], 'pret_id')[0][0];                                    
        }     
          
        foreach($livreIds as $livreId){ 
            $livresSelect[] = $bookInst->selectValueId('id, image, titre, description', 'id', $livreId);                     
        }        
        return $livresSelect;
    }

     public function show($post = [], $get = []){
        $book = new Book;
        $rentBook = new RentHasBook;
        if(isset($post['id']) && $post['id']!=null){                
            $rent = new Rent;
            $rent->initDates();
            $startTime = $rent->getDateDebut()->format('Y/m/d H:i:s');
            $endTime = $rent->getDateFin()->format('Y/m/d H:i:s');
            $dataRent = ['date_debut' => $startTime,
                         'date_fin' => $endTime,
                         'client_id' => $post['id']];              
                                   
            $rent->insert($dataRent);            
            
            $ids = $rent->selectAll($post['id'], 'client_id');
            foreach($ids as $key=>$id){    
                $pretId = $id['id'];    
            }
            $pretHasLivre['pret_id'] = $pretId;
            $pretHasLivre['livre_id'] = $post['bookId'];
            
            $rentBook->insert($pretHasLivre);
            
            $client = new Client;
            $name = $client->selectValueId('nom', 'id', $post['id'])['nom'];

            //Selectionner des livres du client
            foreach($ids as $key=>$id){
                $rentIds = [$key => $id['id']];
                $livreIds[] = $rentBook->selectAll($id['id'], 'pret_id')[0][0];                                    
            }
            foreach($livreIds as $key=>$livreId){ 
                $livresSelect[] = $book->selectValueId('id, image, titre, description', 'id', $livreId);                     
            }            
            $rent->setDateDebut($startTime);
            $duration = $rent->tempsRestant();        
            
            return View::render("client/show", ['id' => $post['id'], 'name'=> $name, 'duration' => $duration, 'books' => $livresSelect]);        
        }else if(isset($get) && $get!=null){
            $rentHasBook = new RentHasBook;
            $rent = new Rent;

            $rentIds = $rent->selectAll($post['client'], 'client_id');
            $rentBookId = $rentHasBook->selectAllinAll('pret_id', $post['book'], 'livre_id')[0][0];

            $rentHasBook->delete('livre_id', $post['book'], 'pret_id', $rentBookId);
            $rent->deleteId($rentBookId, 'id');
                
            $ids = $rent->selectAll($post['client'], 'client_id');
            
            $client = new Client;
            $name = $client->selectValueId('nom', 'id', $post['client'])['nom'];
            $livresSelect = $this->selectBooks($ids, $rentHasBook, $book);
            
            return View::render("client/show", ['id' => $post['client'], 'name'=> $name, 'duration' => 30, 'books' => $livresSelect]);
        }else{ 
                       
             return View::render('error', ['msg'=>'404 page not found!']);
        }
    }

       
    public function create(){       
        return View::render('client/create');
    }

    
    public function login(){
        return View::render('client/login');
    }

    
    public function user($data){        
        $validator = new Validator;
        $validator->field('name', $data['nom'])->min(2)->max(45);          
        $validator->field('email', $data['courriel'])->email()->min(5)->max(45);
        if($validator->isSuccess()){           
            $client = new Client;              
            $idMail = $client->selectValueId('id', 'courriel', $data['courriel'])['id'];
            $idNom = $client->selectValueId('id', 'nom', $data['nom'])['id'];        
            // $insert = $client->insert($data);
            if($idMail && $idNom && $idMail === $idNom){
                return View::redirect('client/order?id='.$idNom);
            }else{
                return View::redirect('client/create');
            }            
        }else{
            $errors = $validator->getErrors();            
            return View::render('client/create', ['errors'=>$errors, 'client'=>$data]);
        }
    }

    public function store($data){                
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(45);        
        $validator->field('adresse', $data['adresse'])->min(3)->max(45);
        $validator->field('telephon', $data['telephone'])->max(20);
        $validator->field('courriel', $data['courriel'])->email()->min(3)->max(45);
        if($validator->isSuccess()){          
            $client = new Client;
            $client->insert($data);
            return View::redirect('client/login');
        }else{
            $errors = $validator->getErrors();            
            return View::render('client/create', ['errors'=>$errors, 'client'=>$data]);
        }
    }
}

?>
<?php

namespace Website\Controllers;

/**
 * Class RegistrationController
 *
 * Deze handelt de registratie's af van gebruikers
 *
 */
class RegistrationController {

	public function registratieForm() {

		$template_engine = get_template_engine();
		echo $template_engine->render('registreren');

//		$template_engine = get_template_engine();
//		echo $template_engine->render('homepage');

    }

    public function verwerkRegistrationForm() {

        $errors = [];
        
        $email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );
        $wachtwoord = trim( $_POST['wachtwoord'] );

        if ( $email === false ) {
            $errors['email'] = 'Geen geldig emailadres ingevuld';
        }

        if ( strlen( $wachtwoord ) < 6 ) {
            $errors['wachtwoord'] = 'Geen geldig wachtwoord ingevuld (minimaal 6 tekens)';
        }

        if ( count( $errors ) === 0 ) {

            $connection = dbConnect();
            $sql        = "SELECT * FROM `gebruikers` WHERE `email` = :email";
            $statement  = $connection->prepare( $sql );
            $statement->execute( [ 'email' => $email ] );

            if ( $statement->rowCount() === 0 ) {
                $sql                = "INSERT INTO `gebruikers` (`email`, `wachtwoord`) VALUES (:email, :wachtwoord)";
                $statement          = $connection->prepare( $sql );
                $safe_password      = password_hash( $wachtwoord, PASSWORD_DEFAULT );
                $params             = [
                    'email'         => $email,
                    'wachtwoord'    => $safe_password
                ];
                $statement->execute( $params );
                
                $bedanktUrl = url('registratie.thanks');
                redirect($bedanktUrl);
            }
        }

        $template_engine = get_template_engine();
        echo $template_engine->render('registreren', ['errors' => $errors]);

    }
    
    public function registratieThanks(){
        $template_engine = get_template_engine();
        echo $template_engine->render("registratie_thanks");
    }

}
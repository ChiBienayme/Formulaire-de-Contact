<?php
/*
Template Name: Contact Form
*/

// Envoyer un message erreur quand la valeur est vide
function notEmptyValidator($message)
{
    return function ($value) use ($message) {
        if (trim($value) === '') {
            return $message;
        }
    };
}

// Verifier l'email
function emailValidator($message)
{
    return function ($value) use ($message) {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $message;
        }
    };
}

// Verifier le numero de telephone, limiter la longeur de 10 a 14 characters
function phoneValidator($message)
{
    return function ($value) use ($message) {
        // Test la longeur de la valeur $value
        // echo '<pre>';
        // var_dump($value);
        // echo '<pre>';

        if ($value != '') {
            if (!preg_match("/^\+?[1-9][0-9]{7,14}$/", $value )) {
                return $message;
            } 
        }
    };
    
}

// afficher des messages s'il y a des erreurs
function showError($errors, $field)
{
    if (isset($errors[$field])) {
        echo sprintf('<span class="error"><br>%s</span>', $errors[$field]);
    }
}

// messages erreurs
$fields = array(
    'submitted' => null,
    'contactName' => notEmptyValidator('* Indiquez votre nom.'),
    'firstName' => notEmptyValidator('* Indiquez votre prénom.'),
    'phone' => phoneValidator('Indiquez votre numéro de téléphone.'),
    'comments' => notEmptyValidator('* Entrez votre message.'),
    'email' => array(
        notEmptyValidator('* Indiquez une adresse e-mail.'),
        emailValidator('* Indiquez une adresse e-mail valide.'),
    ),
);

// l'envoie du mail
$formSubmitted = true;
$formIsValid = true;
$validation = null;
$formErrors = array();
$formDatas = array();

$formDatas = array_map('htmlspecialchars', $formDatas);

// verifier si les valeurs sont vides, ne sont pas envoyes
foreach ($fields as $field => $v) {
    if (!isset($_POST[$field])) {
        $formSubmitted = false;
    }
}

//  Verification des conditions des les varaiables pour la soumission 
if ($formSubmitted) {
    foreach ($fields as $field => $validator) { 
        $value = $_POST[$field]; 

        if ($validator !== null) { 
            $validation = null; 

            if (is_array($validator)) { 
                foreach ($validator as $vld) { 
                    if ($validation === null) { 
                        $validation = $vld($value); 
                    }
                }
            } else {
                $validation = $validator($value);
            }
        }
     
        if ($validation !== null) { 
                $formIsValid = false; 
                $formErrors[$field] = $validation; 
                $formDatas[$field] = null;
        } else {
                $formDatas[$field] = $value; 
        }
    }


    if (function_exists('stripslashes')) {
        $formDatas = array_map('stripslashes', $formDatas);
    }

} else {
    foreach ($fields as $field => $v) {
        $formDatas[$field] = null;
    }
}

// Prise en compte les valeurs d'inputs
if ($formSubmitted && $formIsValid) {
        $contactName = $formDatas['contactName'];
        $firstName = $formDatas['firstName'];
        $phone = $formDatas['phone'];
        $comments = $formDatas['comments'];
        $email = $formDatas['email'];
    
    // Le contenu de l'email
    $mailBody = <<<EOF
        Name: $contactName
        FirstName: $firstName
        Phone: $phone
        Email: $email
        Comments: $comments
    EOF;

    /*Le destinataire*/
    $mailRecipient = 'kevin.t@thewalkingnerds.com';
    $mailSender = 'thewalkingnerds.com <'.$mailRecipient.'>';
    $mailHeaders = array(
        'From: '.$mailSender,
        'Reply-To: '.$mailSender,
        'To: '.$mailRecipient,
    );

    mail(
        $mailRecipient,
        $mailBody,
        implode("\r\n", $mailHeaders)
    );
}

?>


<?php get_header(); ?>

<!-- Messsage de confirmation pour les clients -->
<?php if ($formSubmitted && $formIsValid): ?>
	<div class="thanks">
		<h1>Merci, <?php echo $formDatas['contactName']; ?></h1><br><br>
		<p>Votre e-mail a été envoyé avec succès. Vous recevrez une réponse sous peu.</p>
	</div>

<?php else: ?>
	<?php if (have_posts()) : ?>
	    <?php while (have_posts()) : the_post(); ?>
            <div class="header">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
		    
		    <br/>

		    <?php the_content(); ?>
            <!-- Message erreur -->
            <?php if ($formSubmitted && !$formIsValid): ?>
                <p class="errorForms">Une erreur est survenue lors de l'envoi du formulaire.</p>
                <br/>

            <?php endif; ?>

                <!-- *********************Le Formulaire Contact******************************** -->
                <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                    <ol class="forms">
                        <!-- nom -->
                        <li>
                            <label for="contactName">Votre nom (requis) :</label><br><br>
                            <input type="text" name="contactName" id="contactName" placeholder="Nom" value="<?php echo $formDatas['contactName'] ?>"  />
                            <?php showError($formErrors, 'contactName') ?>
                        </li>

                        <!-- prénom -->
                        <li>
                            <label for="firstName">Votre prénom (requis) :</label><br><br>
                            <input type="text" name="firstName" id="firstName" placeholder="Prénom" value="<?php echo $formDatas['firstName'] ?>"/>
                            <?php showError($formErrors, 'firstName') ?>
                        </li>

                        <!-- numéro de téléphone -->
                        <li>
                            <label for="phone">Votre numéro de téléphone :</label><br><br>
                            <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone" 
                            value="<?php echo $formDatas['phone'] ?>"  />
                            <?php showError($formErrors, 'phone') ?>
                        </li>

                        <!-- email -->
                        <li>
                            <label for="email">Votre e-mail (requis) :</label><br><br>
                            <input type="email" name="email" id="email" placeholder="xxxxxx@xxxx.com" value="<?php echo $formDatas['email'] ?>" />

                            <?php showError($formErrors, 'email') ?>
                        </li>

                        <!-- Comments/message  -->
                        <li class="textarea">
                            <label for="commentsText"> Message (requis) :</label><br><br>
                            <textarea name="comments" id="commentsText" ><?php echo $formDatas['comments'] ?></textarea>
                            <?php showError($formErrors, 'comments') ?>
                        </li>

                        <!-- Envoyer and reset -->
                        <li class="buttons">
                            
                            <input type="hidden" name="submitted" id="submitted" value="true" />
                            <button type="submit">Envoyer</button>

                            <input type="hidden" name="resume" id="resume" value="true"/>
                            <button type="reset">Reset</button>
                        </li>
                    </ol>
                </form>
		<?php endwhile; ?>
	<?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>

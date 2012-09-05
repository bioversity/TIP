<?php
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());

$data = array(
    'name' => 'Your name',
    'email' => 'Your email',
);

$form = $app['form.factory']->createBuilder('form', $data)
    ->add('name')
    ->add('email')
    ->add('gender', 'choice', array(
        'choices' => array(1 => 'male', 2 => 'female'),
        'expanded' => true,
    ))
    ->getForm();

if ('POST' == $request->getMethod()) {
    $form->bindRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        // do something with the data

        // redirect somewhere
        return $app->redirect('...');
    }
}

// display the form
return $app['twig']->render('add_tag.twig', array('form' => $form->createView()));
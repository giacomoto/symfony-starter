<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class ResetPasswordController extends AbstractController
{
    use ResetPasswordControllerTrait;

    public function request(): Response
    {
        return $this->render('reset_password/request.html.twig');
    }

    public function checkEmail(
        ResetPasswordHelperInterface $resetPasswordHelper
    ): Response
    {
        return $this->render('reset_password/check_email.html.twig', [
            'resetToken' => $resetPasswordHelper->generateFakeResetToken(),
        ]);
    }

    public function reset(): Response
    {
        return $this->render('reset_password/reset.html.twig');
    }

    public function success(): Response
    {
        return $this->render('reset_password/success.html.twig');
    }
}
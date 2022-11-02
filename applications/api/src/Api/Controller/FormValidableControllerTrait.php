<?php

declare(strict_types=1);

namespace App\Api\Controller;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait FormValidableControllerTrait
{
    /**
     * @return array<int|string, mixed>
     */
    protected function getErrorsFromForm(FormInterface $form, bool $simplified = true): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            /* @var FormError $error */
            $errors[] = $error->getMessage(); // @phpstan-ignore-line
        }

        foreach ($form->all() as $childForm) {
            if (\count($childErrors = $this->getErrorsFromForm($childForm)) > 0) {
                $errors[$childForm->getName()] = $simplified ? $childErrors[0] : $childErrors;
            }
        }

        return $errors;
    }

    protected function createValidationErrorFromFormResponse(FormInterface $form, bool $simplified = true): Response
    {
        $errors = $this->getErrorsFromForm($form, $simplified);

        return $this->createValidationErrorResponse($errors);
    }

    /**
     * @param array<int|string, mixed> $errors
     */
    protected function createValidationErrorResponse(array $errors): Response
    {
        $data = [
            'type' => 'validation_error',
            'title' => 'There was a validation error',
            'errors' => $errors,
        ];

        $response = new JsonResponse($data, Response::HTTP_BAD_REQUEST);
        $response->headers->set('Content-Type', 'application/problem+json');

        return $response;
    }
}

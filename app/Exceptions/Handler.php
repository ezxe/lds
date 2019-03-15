<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		if ($exception instanceof ValidationException){
			return $this->convertValidationExceptionToResponse($exception, $request);
		}
        if ($exception instanceof ModelNotFoundException){
        	$modelo = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
        }

        if ($exception instanceof AuthenticationException){
        	return $this->unauthenticated($request, $e);
        }

        if ($exception instanceof AuthenticationException)
    	{
       		return $this->unauthenticated($request, $e);
      
    	}
    	if ($exception instanceof AuthenticationException)
    	{
       		return $this->unauthenticated("no posee permisos para ejecutar esta accion", 403);
      
    	}

    	if ($exception instanceof NotFoundHttpException)
    	{
       		return $this->errorResponse("no se encontro la URL especificada", 404);
      
    	}
    	if ($exception instanceof MethodNotAllowedHttpException)
    	{
       		return $this->errorResponse("el metodo especificado en la peticion no es valido", 405);
      
    	}
    	if ($exception instanceof HttpException)
    	{
       		return $this->errorResponse($exception->getMessages(), $exception->getStatusCode());
      
    	}
    	if ($exception instanceof QueryException)
    	{
    		$codigo = $exception->errorInfo[1];

    		if ($codigo == 1451){
    			return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro.', 409);
    		}
		}

		if (config ('app.debug')) {
			return parent::render($request, $exception);
		}
		return $this->errorResponse('Falla inesperada. Intente luego', 500);
		}


    protected function unauthenticated ($request, AuthenticationException $exception)
    {
       return $this->errorResponse('No autenticado.', 401);
      
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, 422);
    }

}

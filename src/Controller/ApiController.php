<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{

    /**
     * @var integer HTTP status code - 200
     */
    protected $statusCode = 200;

    /**
     * Gets value statusCode.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets value statusCode
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Returns a JSON
     * @param mixed $data
     * @param array $headers
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }
    /**
     * Sets error message 
     * @param string $errors
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function respondWithErrors($errors, $headers = [])
    {
        $data = [
            'errors' => $errors,
        ];
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * 401 Unauthorized http
     * @param string $message
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function unauthorized($message = 'Not authorized!')
    {
        return $this->setStatusCode(401)->respondWithErrors($message);
    }
	
	/**
	 * 422
	 * @param string $message
	 * @return Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function validationError($message = 'Validation errors')
	{
		return $this->setStatusCode(422)->respondWithErrors($message);
	}

	/**
	 * 404
	 * @param string $message
	 * @return Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function notFound($message = 'Not found!')
	{
		return $this->setStatusCode(404)->respondWithErrors($message);
	}

	/**
	 * 201
	 * @param array $data
	 * @return Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function created($data = [])
	{
		return $this->setStatusCode(201)->respond($data);
	}
}
<?php 

namespace DFSAInc\JsonResponder;

use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class JsonResponder {
    
    /**
     * The Response Factory for creating JSON responses.
     * 
     * @var Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;
    
    /**
     * The constructor. 
     * 
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     */
    public function __construct(ResponseFactory $response) 
    {
        $this->response = $response;
    }
    
    /*
     * |--------------------------------------------------------------------------
     * | Success Codes (200s)
     * |--------------------------------------------------------------------------
     * |
     * | All of the following functions indicates the action requested by the client
     * | was received, understood, accepted, and processed successfully.
     * |
     */
    /**
     * Return a 200 Response.
     * 
     * @param unknown $payload
     *            The optional payload to send back with the response.
     * @param string $payload            
     * @return Response
     */
    public function ok($msg = null, $payload = null)
    {
        $msg = (is_string($msg) ? $msg : 'OK!');
        return $this->response(true, Response::HTTP_OK, $msg, $payload);
    }

    /**
     * Return a 202 Response.
     *
     * @param string $msg            
     * @param string $payload            
     * @return Response
     */
    public function created($msg = null, $payload = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Created!';
        return $this->response(true, Response::HTTP_CREATED, $msg, $payload);
    }

    /**
     * Returns a 202 Responsehttps://52.2.194.243:8443/Facebook/Authenticate/Test
     * 
     * @param string $msg
     * @param string $payload
     * @return \Illuminate\Http\Response
     */
    public function accepted($msg = null, $payload = null) 
    {
        $msg = (is_string($msg)) ? $msg : 'Accepted!';
        return $this->response(true, Response::HTTP_ACCEPTED, $msg, $payload);
    }
    
    /**
     * Return a 204 Response.
     *
     * @param string $msg            
     * @return Response
     */
    public function no_content($msg = null)
    {
        return $this->response(true, RESPONSE::HTTP_NOT_CONTENT, 'No Content!');
    }

    /*
     * |--------------------------------------------------------------------------
     * | Client Errors (400s)
     * |--------------------------------------------------------------------------
     * |
     * | All of the following functions indicates the action requested by the client
     * | encountered an error due to a client error.
     * |
     */
    /**
     * Return a 400 JSON response.
     *
     * @param string $msg            
     * @param string $payload            
     * @return Response
     */
    public function bad_request($msg = null, $payload = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Bad Request!';
        return $this->response(false, Response::HTTP_BAD_REQUEST, $msg, $payload);
    }

    /**
     * Returns a 401 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function unauthorized($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Unauthorized!';
        return $this->response(false, Response::HTTP_UNAUTHORIZED, $msg);
    }

    /**
     * Returns a 402 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function payment_required($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Payment Required!';
        return $this->response(false, Response::HTTP_PAYMENT_REQUIRED, $msg);
    }

    /**
     * Return a 403 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function forbidden($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Forbidden!';
        return $this->response(false, Response::HTTP_FORBIDDEN, $msg);
    }

    /**
     * Return a 404 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function not_found($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Not Found!';
        return $this->response(false, Response::HTTP_NOT_FOUND, $msg);
    }

    /**
     * Return a 405 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function method_not_allowed($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Method not allowed!';
        return $this->response(false, Response::HTTP_METHOD_NOT_ALLOWED, $msg);
    }

    /**
     * Return a 409 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function conflict($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Conflict!';
        return $this->response(false, Response::HTTP_CONFLICT, $msg);
    }

    /**
     * Return a 419 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function authentication_timeout($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Authentication Timeout';
        return $this->response(false, 419, $msg);
    }

    /*
     * |--------------------------------------------------------------------------
     * | Server Errors (500s)
     * |--------------------------------------------------------------------------
     * |
     * | All of the following functions indicates the action requested by the client
     * | encountered an error due to a server error.
     * |
     */
    /**
     * Return a 500 JSON response.
     *
     * @param string $msg            
     * @return Response
     */
    public function internal_server_error($msg = null)
    {
        $msg = (is_string($msg)) ? $msg : 'Internal Server Error!';
        return $this->response(false, Response::HTTP_INTERNAL_SERVER_ERROR, $msg);
    }

    /*
     * |--------------------------------------------------------------------------
     * | Custom Response builder.
     * |--------------------------------------------------------------------------
     */
    /**
     * Return a JSON response given a result, status code, and optional response payload.
     *
     * @param mixed $result
     *            The result of the request (true = success; false = failure)
     * @param mixed $status
     *            The HTTP response code of the request.
     * @param string $message
     *            A message to send with the response.
     * @param mixed $payload
     *            The optional data to send with the response.
     * @param array $headers
     *            The array of headers to add to the response.
     * @return Response
     */
    public function response($result, $status, $message = null, $payload = null, array $headers=[])
    {
        $result = ($result) ? 'success' : 'error';
        $result = [
            'result' => $result,
            'status' => $status
        ];
        if (is_string($message))
            $result['message'] = $message;
        if ($payload || is_array($payload))
            $result['payload'] = $payload;
        
        $response = $this->response->json($result, $status, $headers);
        return $response;
    }
}
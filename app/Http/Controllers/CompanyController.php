<?php

namespace App\Http\Controllers;

use App\Company\Models;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  protected $companyRepository;

  /**
   * Construct the controller.
   *
   * @param CompanyRepositoryI $companyRepository
   * @return void
   */
  function __construct(CompanyRepositoryI $companyRepository)
  {
    $this->companyRepository = $companyRepository;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param CompraRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(CompraRequest $request)
  {
    $response = $this->companyRepository->store($request->all());

    return $this->response($response);
  }


  /**
   * Store a new user.
   *
   * @param CompanyRequest $request
   * @return Response
   */
  public function index(CompanyRequest $request)
  {
    $response = $this->companyRepository->index($request->all());
    return $this->response($response);
  }

}

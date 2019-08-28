@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" action="{{ route('Fund.store') }}">
          <div class="form-group">
              @csrf
              <label for="LblQuantityDepositWithdrawal">Share Quantity Deposit/Withdrawal:</label>
              <input type="number" class="form-control" name="QuantityDepositWithdrawal"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
</form>

@endsection

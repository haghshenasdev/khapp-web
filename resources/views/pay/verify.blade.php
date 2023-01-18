@extends("layouts.baseTheme")

@section("content")
    <div class="row justify-content-center mt-4 mx-0">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$message}}</div>

                <div class="card-body text-center">

                    {{--icon--}}
                    <div class="col-5 col-lg-3 my-3 mx-auto">
                        @isset($success)
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-check-circle-fill text-green-600" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        @endisset
                    </div>

                    {{--content--}}
                    @isset($success)
                        <h3 class="mb-3">از نیکو کاری شما سپاس گذاریم</h3>
                    @else
                        <h3>{{$message}}</h3>
                    @endisset

                    {{--data--}}
                    @isset($receipt)
                        <table class="table table-striped-columns">
                            <tr>
                                <td>خیریه</td>
                                <td>{{$charity}}</td>
                            </tr>
                            <tr>
                                <td>شماره کارت</td>
                                <td>{{$receipt['CardNumber']}}</td>
                            </tr>
                            <tr>
                                <td>شناسه پرداخت</td>
                                <td>{{$receipt['InvoiceId']}}</td>
                            </tr>
                            <tr>
                                <td>ReferenceId</td>
                                <td>{{$receipt['ReferenceId']}}</td>
                            </tr>
                            <tr>
                                <td>TraceNumber</td>
                                <td>{{$receipt['TraceNumber']}}</td>
                            </tr>
                            <tr>
                                <td>TransactionId</td>
                                <td>{{$receipt['TransactionId']}}</td>
                            </tr>
                        </table>
                    @endisset
                </div>
            </div>

        </div>
    </div>
@endsection

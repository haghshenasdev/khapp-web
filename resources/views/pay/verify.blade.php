@extends("layouts.baseTheme")

@section("content")
    <div class="row justify-content-center mt-4 mx-0">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$message}}</div>

                <div class="card-body text-center">

                    {{--icon--}}
                    <div class="col-5 col-lg-3 my-3 mx-auto">
                        @if(isset($success) && $success)
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                                 class="bi bi-check-circle-fill text-green-600" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor"
                                 class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>

                            @isset($data)
                                <a href="{{ url('invoice/' . $data['sabtid']) }}" class="btn btn-primary mt-3">پرداخت</a>
                            @endisset

                        @endif
                    </div>

                    {{--content--}}
                    @isset($success)
                        @if($success)
                            <h3 class="mb-3">از نیکو کاری شما سپاس گذاریم</h3>
                        @endif
                    @endisset

                    @isset($message)
                        <h3>{{$message}}</h3>
                    @endisset
                    <a class="btn btn-primary mx-auto" href="https://kheiriehemamali/">بازگشت به برنامه</a>
                    <p class="my-4">جهت بازگشت به برنامه ، مرورگر را ببندید و برنامه خیریه را باز کنید .</p>

                    {{--data--}}
                    @isset($receipt)
                        <table class="table table-striped-columns">
                            <tr>
                                <td>خیریه</td>
                                <td>{{$charity}}</td>
                            </tr>
                            <tr>
                                <td>شماره کارت</td>
                                <td dir="ltr">{{$receipt['CardNumber']}}</td>
                            </tr>
                            <tr>
                                <td>شناسه صورتحساب</td>
                                <td>{{$receipt['InvoiceId']}}</td>
                            </tr>
                            <tr>
                                <td>شماره ارجاع بانکی</td>
                                <td>{{$receipt['ReferenceId']}}</td>
                            </tr>
                            <tr>
                                <td>شماره پیگیری</td>
                                <td>{{$receipt['TraceNumber']}}</td>
                            </tr>
                        </table>
                    @endisset

                    @isset($data)
                        <table class="table table-striped-columns">
                            <tr>
                                <td>مبلغ</td>
                                <td>{{number_format($data['amount'])}} تومان</td>
                            </tr>
                            <tr>
                                <td>کاربر پرداخت کننده</td>
                                <td>{{$data['name']}}</td>
                            </tr>
                            <tr>
                                <td>خیریه</td>
                                <td>{{$charity}}</td>
                            </tr>
                            <tr>
                                <td>پرداخت جهت</td>
                                <td>{{$data['title']}}</td>
                            </tr>
                            <tr>
                                <td>توضیح مورد مصرف</td>
                                <td>{{$data['description']}}</td>
                            </tr>
                            <tr>
                                <td>شماره پیگیری تراکنش</td>
                                <td>{{$data['ResNum']}}</td>
                            </tr>
                            <tr>
                                <td>شماره ثبت در خیریه</td>
                                <td>{{$data['sabtid']}}</td>
                            </tr>
                            <tr>
                                <td>تاریخ ایجاد</td>
                                <td>{{$data['created_at']}}</td>
                            </tr>
                            <tr>
                                <td>تاریخ پرداخت</td>
                                <td>{{$data['updated_at']}}</td>
                            </tr>
                        </table>
                    @endisset

                </div>
            </div>

        </div>
    </div>
@endsection

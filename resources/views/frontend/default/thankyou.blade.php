@extends('frontend.default.master')
@section('content')
    <section id="thankyou">
        <div class="container">
            <div class="col-md-12">
                <h3 class="page-header">Cảm ơn bạn đã đặt hàng tại Website</h3>
                <div class="alert alert-success">
                    Mã đơn hàng #{{ session('orderID') }} đã được đặt hàng thành công.
                </div>
            </div>
        </div>
    </section>
@endsection
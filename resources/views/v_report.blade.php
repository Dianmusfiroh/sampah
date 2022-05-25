<div class="content-header">
    <div>
        <h2 class="content-title card-title">Report</h2>
        <p>Whole data about your business here</p>
    </div>
    <div>

        <a href="{{ route('cetakAktif') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Download Member Aktif</a>
        <a href="{{ route('cetakNonAktif') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Download Member Expired</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Top Seles By Toko</h5>
                <div class="new-member-list">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <img src="assets/imgs/people/avatar-4.png" alt="" class="avatar" />
                            <div>
                                <h6>Patric Adams</h6>
                                <p class="text-muted font-xs">Sanfrancisco</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-xs"><i class="material-icons md-add"></i> Add</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Top Produk</h5>
                <ul class="verti-timeline list-unstyled font-sm">
                    <li class="event-list">

                        <div class="media">
                            <div class="me-3">
                                <h6><i class="material-icons md-trending_flat text-brand ml-15 d-inline-block"></i></h6>
                            </div>

                            <div class="media-body">
                                <div>Lorem ipsum dolor sit amet consectetur</div>
                            </div>
                        </div>
                    </li>
                    {{--  <li class="event-list active">
                        <div class="event-timeline-dot">
                        </div>
                        <div class="media">
                            <div class="me-3">
                                <h6><span>17 May</span> <i class="material-icons md-trending_flat text-brand ml-15 d-inline-block animation-fade-right"></i></h6>
                            </div>
                            <div class="media-body">
                                <div>Debitis nesciunt voluptatum dicta reprehenderit</div>
                            </div>
                        </div>
                    </li>  --}}
                </ul>
            </article>
        </div>
    </div>
</div>

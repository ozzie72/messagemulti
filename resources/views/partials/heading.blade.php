<header class="page-header">
    <h2>Sistema Gestión Message</h2>

    <div class="right-wrapper text-end mr-4">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="bx bx-home-alt"></i>
                </a>
            </li>

            @isset($linkPrev)
                <li><span>{{ $linkPrev }}</span></li>
            @endisset

            @isset($linkCurrent)
                <li><span>{{ $linkCurrent }}</span></li>
            @endisset

        </ol>
    </div>
</header>
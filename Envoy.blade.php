@servers(['web' => 'web@qvservers.fr'])

@setup
    $dir = "/home/web/www";
    $releases = 3;
    $remote = "git@qvservers.fr:root/QVserver.git";

    $shared = $dir . '/shared';
    $current = $dir . '/current';
    $repo = $dir . '/repo';
    $release = $dir . "/releases/" . date('YmdHis');
@endsetup

@macro('deploy')
    createrelease
    composer
    linkcurrent
@endmacro

@task('prepare')
    mkdir -p {{ $shared }};
    @if($remote)
        git clone --bare {{ $remote }} {{ $repo }}
    @else
        mkdir -p {{ $repo }};
        cd {{ $repo }};
        git init --bare;
        echo  "{{ $repo }}";
    @endif
@endtask

@task('createrelease')
    mkdir -p {{ $release }};
    @if($remote)
        [ -d {{ $repo }} ] || git clone {{ $remote }} {{ $repo }};
        cd {{ $repo }};
        git remote update;
    @endif
    cd {{ $repo }};
    git archive master | tar -x -C {{ $release }};
    echo "Création de {{ $release }}";
@endtask

@task('composer')
    mkdir -p {{ $shared }}/vendor;
    ln -s {{ $shared }}/vendor {{ $release }}/vendor;
    cd {{ $release }};
    composer update --no-dev --no-progress;
@endtask


@task('linkcurrent')
    rm -rf {{ $current }};
    ln -s {{ $release }} {{ $current }};
    ls {{ $dir }}/releases | sort -r | tail -n +{{ $releases + 1 }} | xargs -I{} -r rm -rf {{ $dir }}/releases/{};
    echo "Lien // {{ $current }} --> {{ $release }}";
    rm -rf {{$repo}}
@endtask


@task('rollback')
    rm -f {{ $current }};
    ls {{ $dir }}/releases | tail -n 2 | head -n 1 | xargs -I{} -r ln -s {{ $dir }}/releases/{} {{ $current }};
@endtask

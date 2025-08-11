<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventContactRequest;
use App\Models\EventContact;
use App\Repositories\CommitRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\ServiceRepositoryInterface;

class NewsController extends Controller
{

    protected $repository;
    protected $commitRepository;

    public function __construct(
        ServiceRepositoryInterface $repository,
        CommitRepositoryInterface $commitRepository
    ) {
        $this->repository = $repository;
        $this->commitRepository = $commitRepository;
    }

    /**
     * Create data for contacts
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return status
     */
    public function detail(Request $request, $slug)
    {
        $data = $this->repository->bySlug($slug);
        if (!$data) {
            abort('404');
        }
        $filter = [
            'active' => 1,
            'publish' => true,
            'not_in_id' => $data->id
        ];
        $news = $this->repository->filterFrontEnd($filter);
        $commits = $this->commitRepository->filter(['active' => 1]);

        return view(
            'frontend.news.detail',
            compact(
                'data',
                'news',
                'commits',
                // 'route',
            )
        );
    }
}

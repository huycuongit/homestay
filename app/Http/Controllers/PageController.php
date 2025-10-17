<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\System;
use App\Repositories\BranchRepositoryInterface;
use App\Repositories\CommitRepositoryInterface;
use App\Repositories\CompanyHistoryRepositoryInterface;
use App\Repositories\DocumentTypeRepositoryInterface;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\ReportRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    protected $eventRepository;
    protected $newsRepository;
    protected $tipRepository;
    protected $deveMileRepository;
    protected $branchRepository;
    protected $documentTypeRepository;
    protected $district;
    protected $commitRepository;
    protected $serviceRepository;
    protected $imageRepository;
    protected $galleryRepository;

    public function __construct(
        NewsRepositoryInterface $newsRepository,
        ServiceRepositoryInterface $serviceRepository,
        CommitRepositoryInterface $commitRepository,
        ImageRepositoryInterface $imageRepository,
        GalleryRepositoryInterface $galleryRepository

    ) {
        $this->newsRepository = $newsRepository;
        $this->serviceRepository = $serviceRepository;
        $this->commitRepository = $commitRepository;
        $this->imageRepository = $imageRepository;
        $this->galleryRepository = $galleryRepository;
    }

    public function index(Request $request)
    {
        $filter = [
            'active' => 1
        ];
        $services = $this->serviceRepository->filter($filter);
        $commits = $this->commitRepository->filter($filter);
        if ($request->ajax()) {
            $params = $request->input();
            $params['expired'] = false;
            return [
                "data" => view(
                    'frontend.jobs.list',
                    compact('companyHistories', 'lastUpdate')
                )->render(),
            ];
        }
        $data = [
            'services' => $services,
            'commits' => $commits,
        ];

        return view('frontend.pages.index', $data);
    }

    public function bySlug(Request $request, $slug)
    {
        $view = 'frontend.pages.';
        $rq = $request->input();
        $avariables = [];

        switch ($slug) {
            case 'dich-vu':
                $filter = array_merge([
                    'active' => 1,
                    'publish' => true
                ], $rq);
                $services = $this->serviceRepository->filter(['active' => 1]);
                $commits = $this->commitRepository->filter(['active' => 1]);
                $avariables['services'] = $services;
                $avariables['commits'] = $commits;

                if ($request->ajax()) {
                    return [
                        "data" => view(
                            'frontend.careers.list',
                            compact('workUnits', 'workUnitFilters')
                        )->render(),
                    ];
                }
                $avariables['requests'] = $rq;

                $view .= 'service';
                break;

            case 'tin-tuc':
                $filter = array_merge([
                    'active' => 1,
                    'publish' => true
                ], $rq);
                $news = $this->newsRepository->filterFrontEnd($filter);
                $avariables['news'] = $news;

                if ($request->ajax()) {
                    return [
                        "data" => view(
                            'frontend.news.list',
                            compact('')
                        )->render(),
                    ];
                }
                $avariables['requests'] = $rq;

                $view .= 'news';
                break;

            case 'thu-vien-anh':
                $filter = array_merge([
                    'active' => 1,
                ], $rq);
                $commits = $this->commitRepository->filter(['active' => 1]);
                $images = $this->imageRepository->filter($filter);
                $galleries = $this->galleryRepository->filter(['active' => 1]);
                $avariables['images'] = $images;
                $avariables['galleries'] = $galleries;
                $avariables['commits'] = $commits;

                if ($request->ajax()) {
                    return [
                        "data" => view(
                            'frontend.galleries.list',
                            compact('images')
                        )->render(),
                    ];
                }
                $view .= 'image';
                break;
                
            case 'gioi-thieu':
                $commits = $this->commitRepository->filter(['active' => 1]);
                $services = $this->serviceRepository->filter(['active' => 1]);

                $avariables['commits'] = $commits;
                $avariables['services'] = $services;

                $view .= 'about';
                break;
            case 'lien-he':
                $commits = $this->commitRepository->filter(['active' => 1]);
                $avariables['commits'] = $commits;

                $view .= 'contact';
                break;

            default:
                abort(404);
        }

        return view($view)
            ->with($avariables);
    }

    public function saveLogs(Request $request)
    {
        $data = $request->input();
        $nameFile = $data['name_file'];
        $pathFile = $data['path_file'];
        $title = $data['title'];
        $action = $data['action'];

        $customer = Auth::guard('web')->user();
        log_activity($customer, $action, $title, [
            'guard' => 'Web',
            'file_name' => $nameFile,
            'file_path' => $pathFile
        ]);
    }
}

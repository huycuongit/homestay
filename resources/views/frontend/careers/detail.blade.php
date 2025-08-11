@extends('frontend.layouts.master')

@section('css')
@endSection

@push('css')
    <style>
        body {
            background: var(--White-color, #FFFFFF);
        }

        @media screen and (max-width: 767px) {
            /***** Hero CSS *****/
            #hero {
                padding: 80px 0 20px;
            }

            .container {
                max-width: 1040px;
            }

            .custom-container {
                max-width: unset !important;
                padding: 0px;
            }

            .banner {
                max-width: 100%;
                width: 100%;
                height: auto;
                object-fit: cover;
                overflow: hidden;
                /* height: 100%; */
            }

            /***** End hero CSS *****/

            /***** Job Deatail CSS *****/
            .job-info-component {
                width: 100%;
                height: 100%;
                /* padding: 70px 0 40px; */
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 16px;
            }

            .job-title {
                color: var(--Main-color, #FF8B00);
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(1, 1fr);
                gap: 14px;
                border-radius: 20px;
                background: var(--Grey-color-6, #F7F7F7);
                padding: 14px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 14px;
                font-style: normal;
                font-weight: 700;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-2, #6A6A6A);
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%; 
            }

            .item {
                max-width: 100%;
                width: 100%;
                display: flex;
                gap: 12px;
            }
            .item-icon svg {
                width: 22px;
                height: 22px;
            }

            .btn-apply {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                background: var(--Main-color, #FF8B00);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                margin-bottom: 20px;
                text-decoration: none;
                transition: width 0.4s ease;
            }
            .btn-apply i {
                opacity: 0;
                transform: translateX(-10px);
                transition: opacity 0.4s ease, transform 0.4s ease;
                margin-left: 5px;
            }

            .btn-apply:hover {
                width: 220px;
            }

            .btn-apply:hover i {
                opacity: 1;
                transform: translateX(0);
            }

            .btn-apply-expired {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);
                background: var(--Grey-color-5, #E1E1E1);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;
                margin-bottom: 20px;
                text-decoration: none;
                transition: width 0.4s ease;
            }
            .btn-apply-expired i {
                display: none;
            }
            .job-detail-component {
                justify-content: space-between;
                padding-top: 40px;
                display: flex;
                gap: 40px;
                flex-direction: column;
            }

            .job-detail-content {
                font-style: normal;
                font-weight: 300;
                line-height: 150%;
                max-width: 1200px;
                width: 100%;
            }
            .job-detail-content strong{
                font-weight: 600;
            }
            .job-detail-content img {
                width: 100% !important;
                height: 100%;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-detail-related {
                max-width: 1200px;
                width: 100%;
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;

                border-radius: 20px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);

                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 40px;
            }

            .job-detail-social-icons {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .job-detail-social-icons a {
                font-size: 33px;
                color: black;
            }

            .job-related-block {
                display: flex;
                padding: 40px 20px;
                flex-direction: column;
                align-items: flex-start;
                align-self: stretch;

                gap: 20px;
                border-radius: 20px;
                border: 1px solid var(--Xm-Xm-5, #E1E1E1);
            }

            .job-related-block-title {
                display: flex;
                padding-bottom: 20px;
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                color: var(--Main-color, #FF8B00);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
                width: 100%;
            }

            .job-related-name {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .job-related-branch {
                color: var(--Grey-color, #808080);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .job-related {
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                text-decoration: none;
                display: flex;
                flex-direction: column;
                gap: 5px;
                padding-bottom: 20px;
                width: 100%;
            }

            .job-related:hover .job-related-name {
                color: var(--Main-color, #FF8B00);
            }

            .btn-view-all-jobs {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);

                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                /* 150% */
                text-decoration: none;
            }

            /***** End job *****/

            /***** Recuitment process CSS *****/
            #recuitment-process {
                padding: 40px 0 40px;
            }

            .recuitment-title {
                color: var(--Main-color-1, #FF8B00);
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .recuitment-process-img img {
                width: 100%;
                border-radius: 12px;
            }

            .recuitment-process-img {
                padding: 16px 0 0;
            }

            /***** End recuitment process CSS *****/

            /***** End Support contact CSS *****/
            #contact-support {
                padding-bottom: 20px;
            }

            .contact-support-block {
                gap: 20px;
            }

            .contact-form-title-block {
                display: flex;
                gap: 8px;
                flex-direction: column;
                padding-bottom: 20px;
            }

            .contact-form-title {
                color: var(--Main-color, #FF8B00);
                text-transform: capitalize;
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .contact-form-second-title {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;

                display: flex;
                height: 43px;
                flex-direction: column;
                justify-content: center;
                align-self: stretch;
            }

            .social-icons {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .social-icons a {
                font-size: 38px;
                color: #000000;
            }


            .text-form {
                color: var(--Grey-color, #808080);
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                margin-bottom: 15px;
            }


            #button-submit {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
            }

            .form-control-support:focus {
                color: var(--bs-body-color);
                background-color: var(--bs-body-bg);
                border-color: #ff8b00;
                outline: 0;
                box-shadow: 0 0 0 2px #ff8b00;
            }

            .form-control-support {
                display: flex;
                height: 100%;
                padding: 11px 15px 10px 15px;
                justify-content: center;
                align-items: center;
                align-self: stretch;
                border-radius: 4px;
                background: rgba(247, 247, 247, 0.97);
                width: 100%;
                border: none;
            }

            .form-control-support::placeholder {
                color: #DADADA;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .form-group-support {
                margin-bottom: 15px;
            }

            /***** End Support contact CSS *****/

        }

        @media screen and (min-width: 768px) and (max-width: 1199px) {
            /***** Hero CSS *****/
            #hero {
                padding: 80px 0 50px;
            }

            .container {
                max-width: 1040px;
            }

            .custom-container {
                max-width: unset !important;
                padding: 0px;
            }

            .banner {
                max-width: 100%;
                width: 100%;
                height: auto;
                object-fit: cover;
                overflow: hidden;
                /* height: 100%; */
            }

            /***** End hero CSS *****/

            /***** Job Deatail CSS *****/
            .job-info-component {
                width: 100%;
                height: 100%;
                /* padding: 70px 0 40px; */
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 20px;
            }

            .job-title {
                color: var(--Cam-0, #FF8B00);
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(4, 1fr);
                gap: 28px 0;
                border-radius: 20px;
                background: var(--Grey-color-6, #F7F7F7);
                padding: 14px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%;
            }

            .item {
                max-width: 184px;
                width: 100%;
                display: flex;
                gap: 12px;
            }

            .item-icon svg {
                width: 22px;
                height: 22px;
            }

            .btn-apply {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                background: var(--Main-color, #FF8B00);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                margin-bottom: 20px;
                text-decoration: none;
                transition: width 0.4s ease;
            }
            .btn-apply i {
                opacity: 0;
                transform: translateX(-10px);
                transition: opacity 0.4s ease, transform 0.4s ease;
                margin-left: 5px;
            }

            .btn-apply:hover {
                width: 220px;
            }

            .btn-apply:hover i {
                opacity: 1;
                transform: translateX(0);
            }

            .btn-apply-expired {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);
                background: var(--Grey-color-5, #E1E1E1);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;
                margin-bottom: 20px;
                text-decoration: none;
            }
            .btn-apply-expired i {
                display: none;
            }
            .job-detail-component {
                justify-content: space-between;
                padding-top: 70px;
                display: flex;
                gap: 50px;
                flex-direction: column;
            }

            .job-detail-content {
                font-style: normal;
                font-weight: 300;
                line-height: 150%;
                max-width: 1200px;
                width: 100%;
            }
            .job-detail-content strong{
                font-weight: 600;
            }
            .job-detail-content img {
                width: 100% !important;
                height: 100%;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-detail-related {
                max-width: 1200px;
                width: 100%;
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;

                border-radius: 20px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);

                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 40px;
            }

            .job-detail-social-icons {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .job-detail-social-icons a {
                font-size: 33px;
                color: black;
            }

            .job-related-block {
                display: flex;
                padding: 40px 20px;
                flex-direction: column;
                align-items: flex-start;
                align-self: stretch;

                gap: 20px;
                border-radius: 20px;
                border: 1px solid var(--Xm-Xm-5, #E1E1E1);
            }

            .job-related-block-title {
                display: flex;
                padding-bottom: 20px;
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                color: var(--Main-color, #FF8B00);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
                width: 100%;
            }

            .job-related-name {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .job-related-branch {
                color: var(--Grey-color, #808080);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .job-related {
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                text-decoration: none;
                display: flex;
                flex-direction: column;
                gap: 5px;
                padding-bottom: 20px;
                width: 100%;
            }

            .job-related:hover .job-related-name {
                color: var(--Main-color, #FF8B00);
            }

            .btn-view-all-jobs {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);

                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                /* 150% */
                text-decoration: none;
            }

            /***** End job *****/

            /***** Recuitment process CSS *****/
            #recuitment-process {
                padding: 70px 0 70px;
            }

            .recuitment-title {
                color: var(--Main-color-1, #FF8B00);
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .recuitment-process-img img {
                width: 100%;
                border-radius: 12px;
            }

            .recuitment-process-img {
                padding: 50px 0 0;
            }

            /***** End recuitment process CSS *****/

            /***** End Support contact CSS *****/
            #contact-support {
                padding-bottom: 40px;
            }

            .contact-support-block {
                gap: 20px;
            }

            .contact-form-title-block {
                display: flex;
                gap: 8px;
                flex-direction: column;
                padding-bottom: 20px;
            }

            .contact-form-title {
                text-transform: capitalize;
                font-size: 26px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
            }

            .contact-form-second-title {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;

                display: flex;
                height: 43px;
                flex-direction: column;
                justify-content: center;
                align-self: stretch;
            }

            .social-icons {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .social-icons a {
                font-size: 38px;
                color: #000000;
            }


            .text-form {
                color: var(--Grey-color, #808080);
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                margin-bottom: 15px;
            }


            #button-submit {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
            }

            .form-control-support:focus {
                color: var(--bs-body-color);
                background-color: var(--bs-body-bg);
                border-color: #ff8b00;
                outline: 0;
                box-shadow: 0 0 0 2px #ff8b00;
            }

            .form-control-support {
                display: flex;
                height: 100%;
                padding: 11px 15px 10px 15px;
                justify-content: center;
                align-items: center;
                align-self: stretch;
                border-radius: 4px;
                background: rgba(247, 247, 247, 0.97);
                width: 100%;
                border: none;
            }

            .form-control-support::placeholder {
                color: #DADADA;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .form-group-support {
                margin-bottom: 15px;
            }

            /***** End Support contact CSS *****/

        }

        @media screen and (min-width: 1200px) {
            /***** Hero CSS *****/
            #hero {
                padding: 87px 0 0;
            }

            .container {
                max-width: 1040px;
            }

            .custom-container {
                max-width: unset !important;
                padding: 0px;
            }

            .banner {
                max-width: 100%;
                width: 100%;
                height: auto;
                object-fit: cover;
                overflow: hidden;
                /* height: 100%; */
            }

            /***** End hero CSS *****/

            /***** Job Deatail CSS *****/
            .job-info-component {
                width: 100%;
                height: 100%;
                padding: 70px 0 40px;
            }

            .title-block {
                flex-direction: column;
                gap: 8px;
                padding-bottom: 40px;
            }

            .job-title {
                color: var(--Cam-0, #FF8B00);
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                text-transform: capitalize;
                margin-bottom: 0;
            }

            .expired-date {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .info-content {
                display: grid;
                width: 100%;
                flex-wrap: wrap;
                grid-template-columns: repeat(4, 1fr);
                gap: 22px 0;
                border-radius: 20px;
                background: var(--Grey-color-6, #F7F7F7);
                padding: 32px 40px;
            }

            .item-name {
                color: var(--Grey-color-1, #363535);
                font-size: 14px;
                font-style: normal;
                font-weight: 700;
                line-height: 136%;
            }

            .item-value {
                color: var(--Grey-color-2, #6A6A6A);
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
                line-height: 136%;
            }

            .item {
                display: flex;
                gap: 12px;
            }
            .item-icon svg {
                width: 22px;
                height: 22px;
            }

            .btn-apply {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);
                background: var(--Main-color, #FF8B00);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                text-decoration: none;
                transition: width 0.4s ease;
            }

            .btn-apply i {
                opacity: 0;
                transform: translateX(-10px);
                transition: opacity 0.4s ease, transform 0.4s ease;
                margin-left: 5px;
            }

            .btn-apply:hover {
                width: 220px;
            }

            .btn-apply:hover i {
                opacity: 1;
                transform: translateX(0);
            }
            .btn-apply-expired {
                display: inline-flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                border-radius: 10000px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);
                background: var(--Grey-color-5, #E1E1E1);

                color: var(--White-color, #FFFFFF);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 700;
                line-height: 24px;
                text-decoration: none;
                pointer-events: none;
            }
            .btn-apply-expired i {
                display:none;
            }
            .job-detail-component {
                justify-content: space-between;
                padding: 0 0 140px;
                display: flex;
                gap: 90px;
            }

            .job-detail-content {
                font-style: normal;
                font-weight: 300;
                line-height: 150%;
                max-width: 584px;
            }
            .job-detail-content strong{
                font-weight: 600;
            }

            .job-detail-content img {
                width: 100% !important;
                height: 100%;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-image {
                width: 100% !important;
                height: 100%;
                max-height: 291px;
                object-fit: cover;
                border-radius: 12px;
                display: block;
                overflow: hidden;
            }

            .job-detail-related {
                max-width: 366px;
                width: 100%;
            }

            .contact-block {
                display: flex;
                padding: 20px 15px;
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;

                border-radius: 20px;
                border: 1px solid var(--Grey-color-5, #E1E1E1);

                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
                margin-bottom: 40px;
            }

            .job-detail-social-icons {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .job-detail-social-icons a {
                font-size: 33px;
                color: black;
            }

            .job-related-block {
                display: flex;
                padding: 40px 20px;
                flex-direction: column;
                align-items: flex-start;
                align-self: stretch;

                gap: 20px;
                border-radius: 20px;
                border: 1px solid var(--Xm-Xm-5, #E1E1E1);
            }

            .job-related-block-title {
                display: flex;
                padding-bottom: 20px;
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                color: var(--Main-color, #FF8B00);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
                width: 100%;
            }

            .job-related-name {
                color: var(--Grey-color-1, #363535);
                font-size: 20px;
                font-style: normal;
                font-weight: 500;
                line-height: 135%;
            }

            .job-related-branch {
                color: var(--Grey-color, #808080);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .job-related {
                border-bottom: 1px solid var(--Border-color, #D9D9D9);
                text-decoration: none;
                display: flex;
                flex-direction: column;
                gap: 5px;
                padding-bottom: 20px;
                width: 100%;
            }

            .job-related:hover .job-related-name {
                color: var(--Main-color, #FF8B00);
            }

            .btn-view-all-jobs {
                display: flex;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 10000px;
                border: 1px solid var(--Main-color, #FF8B00);

                color: var(--Main-color, #FF8B00);
                text-align: center;
                font-family: "Be Vietnam Pro";
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
                /* 150% */
                text-decoration: none;
            }

            /***** End job *****/

            /***** Recuitment process CSS *****/
            #recuitment-process {
                padding: 0 0 140px;
            }

            .recuitment-title {
                color: var(--Main-color-1, #FF8B00);
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                text-transform: capitalize;
            }

            .recuitment-process-img img {
                width: 100%;
                border-radius: 12px;
            }

            .recuitment-process-img {
                padding: 48px 0 0;
            }

            /***** End recuitment process CSS *****/

            /***** End Support contact CSS *****/
            #contact-support {
                padding-bottom: 90px;
            }

            .contact-form-title-block {
                display: flex;
                gap: 8px;
                flex-direction: column;
            }

            .contact-form-title {
                color: var(--Main-color, #FF8B00);
                font-size: 32px;
                font-style: normal;
                font-weight: 500;
                line-height: normal;
                text-transform: capitalize;
            }

            .contact-form-second-title {
                color: var(--Grey-color-1, #363535);
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .social-icons {
                display: flex;
                gap: 6px;
                font-size: 40px;
            }

            .social-icons a {
                color: #000000;
            }


            .text-form {
                color: var(--Grey-color, #808080);
                font-size: 14px;
                font-style: normal;
                font-weight: 300;
                line-height: normal;
                margin-bottom: 15px;
            }


            #button-submit {
                display: flex;
                width: 200px;
                padding: 15px 25px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex-shrink: 0;
                border-radius: 10000px;
                background: var(--Main-color, #FF8B00);
                border: none;

                color: var(--White-color);
                text-align: center;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 24px;
            }

            .form-control-support:focus {
                color: var(--bs-body-color);
                background-color: var(--bs-body-bg);
                border-color: #ff8b00;
                outline: 0;
                box-shadow: 0 0 0 2px #ff8b00;
            }

            .form-control-support {
                display: flex;
                height: 100%;
                padding: 11px 15px 10px 15px;
                justify-content: center;
                align-items: center;
                align-self: stretch;
                border-radius: 4px;
                background: rgba(247, 247, 247, 0.97);
                width: 100%;
                border: none;
            }

            .form-control-support::placeholder {
                color: #DADADA;
                font-size: 16px;
                font-style: normal;
                font-weight: 400;
                line-height: 136%;
            }

            .form-group-support {
                margin-bottom: 15px;
            }

            /***** End Support contact CSS *****/

        }
    </style>
@endpush

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="container custom-container">

            <div class="hero-block">
                <picture>
                    <source media="(min-width: 1200px)"
                        srcset="{{ isset($banners['desktop_banner']) ? checkValue($banners['desktop_banner'], 'url') : '' }}">

                    <source media="(min-width: 768px) and (max-width: 1199px)"
                        srcset="{{ isset($banners['tablet_banner']) ? checkValue($banners['tablet_banner'], 'url') : '' }}">

                    <source media="(max-width: 767px)"
                        srcset="{{ isset($banners['mobile_banner']) ? checkValue($banners['mobile_banner'], 'url') : '' }}">

                    <img class="banner"
                        src="{{ isset($banners['desktop_banner']) ? checkValue($banners['desktop_banner'], 'url') : asset('assets/imgs/branch-banner.png') }}"
                        alt="About Banner">
                </picture>
            </div>
        </div>
    </section>
    <!-- ======= Hero Section ======= -->

    <!-- ======= Job Detail ======= -->
    <section id="job-detail">
        <div class="container ">
            <div class="row">
                <div class="job-info-component">
                    @if (isset($data) > 0)
                        <div class="job-info">
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="d-flex title-block">
                                        <h1 class="job-title">{{ checkValue($data, 'title') }}</h1>
                                        <div class="expired-date d-flex align-items-center">
                                            Hạn nhận hồ sơ: {{ checkValue($data, 'apply_expired_formatted') }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="cta-button-block col-xl-3">
                                    <div href="#" class="btn-lg btn-cta btn-contactModal"
                                    role="button" aria-pressed="true">Đăng ký trải nghiệm <i class="fa-solid fa-arrow-right "></i></div>
                                </div> --}}
                                <div class="col-xl-3">
                                    <div class="job-item-apply">
                                        <a href="{{ route('career.apply', ['slug' => $data->slug]) }}"
                                            class="btn-submit {{ $data->is_expired ? 'btn-apply-expired' : 'btn-apply' }}"
                                            role="button" aria-pressed="true">
                                            Ứng tuyển ngay <i class="fa-solid fa-arrow-right "></i></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="info-content">
                                    {{-- <div class="row">
                                        <div class=""></div>
                                    </div> --}}
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.75 7.00067C1.75 5.11315 3.28014 3.58301 5.16766 3.58301H16.8323C18.7199 3.58301 20.25 5.11315 20.25 7.00067V14.9987C20.25 16.8862 18.7199 18.4163 16.8323 18.4163H5.16767C3.28014 18.4163 1.75 16.8862 1.75 14.9987V7.00067ZM5.16766 5.58301C4.38471 5.58301 3.75 6.21772 3.75 7.00067V7.24964H18.25V7.00067C18.25 6.21772 17.6153 5.58301 16.8323 5.58301H5.16766ZM3.75 14.9987V9.24964H18.25V14.9987C18.25 15.7816 17.6153 16.4163 16.8323 16.4163H5.16767C4.38471 16.4163 3.75 15.7816 3.75 14.9987ZM7.3327 11.8329C6.78042 11.8329 6.3327 12.2806 6.3327 12.8329C6.3327 13.3852 6.78042 13.8329 7.3327 13.8329H10.9994C11.5517 13.8329 11.9994 13.3852 11.9994 12.8329C11.9994 12.2806 11.5517 11.8329 10.9994 11.8329H7.3327Z" fill="#363535"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name"> 
                                                Thu nhập
                                            </div>
                                            <div class="item-value">{{ checkValue($data, 'salary_text') }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.66165 6.0845C8.66165 5.30155 9.29636 4.66684 10.0793 4.66684H12.5773C13.3603 4.66684 13.995 5.30155 13.995 6.0845V6.33347H8.66165V6.0845ZM6.66165 6.33347V6.0845C6.66165 4.19698 8.19179 2.66684 10.0793 2.66684H12.5773C14.4648 2.66684 15.995 4.19698 15.995 6.0845V6.33347H17.1613C19.0488 6.33347 20.5789 7.86361 20.5789 9.75114V15.9158C20.5789 17.8033 19.0488 19.3335 17.1613 19.3335H5.49661C3.60909 19.3335 2.07895 17.8033 2.07895 15.9158V9.75114C2.07895 7.86361 3.60909 6.33347 5.49661 6.33347H6.66165ZM13.995 8.33347H8.66165V17.3335H13.995V8.33347ZM15.995 17.3335V8.33347H17.1613C17.9442 8.33347 18.5789 8.96818 18.5789 9.75114V15.9158C18.5789 16.6988 17.9442 17.3335 17.1613 17.3335H15.995ZM6.66165 17.3335H5.49661C4.71366 17.3335 4.07895 16.6988 4.07895 15.9158V9.75114C4.07895 8.96818 4.71366 8.33347 5.49661 8.33347H6.66165V17.3335Z" fill="#363535"/>
                                              </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Khối làm việc</div>
                                            <div class="item-value">{{ checkValue($data->jobType->workUnit, 'name') }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.2393 5.12395L19.114 3.37451H17.1581H6.15805H4.94922V4.58334V11.9167V12.8333V18.3333C4.94922 19.001 5.49043 19.5422 6.15805 19.5422C6.82567 19.5422 7.36688 19.001 7.36688 18.3333V13.1255H17.1581H19.114L18.2393 11.3761L16.6762 8.25001L18.2393 5.12395ZM14.2435 8.79062L15.2021 10.7078H7.36688V5.79218H15.2021L14.2435 7.7094L13.9732 8.25001L14.2435 8.79062Z" fill="#363535"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Phòng ban</div>
                                            <div class="item-value">{{ checkValue($data->jobType, 'name') }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.738 5.53508V14.304C16.0507 14.3996 16.3527 14.5412 16.6339 14.7286L17.0341 14.9954C17.9762 15.6235 19.2381 14.9481 19.2381 13.8158V8.62719C19.2381 8.15319 19.0012 7.71055 18.6068 7.44762L15.738 5.53508ZM13.738 14.3041V5.53521L11.1339 7.27129C10.8527 7.45873 10.5507 7.60027 10.2381 7.6959V16.4648L12.8424 14.7286C13.1235 14.5412 13.4254 14.3997 13.738 14.3041ZM7.34235 7.27129C7.62349 7.45871 7.92547 7.60024 8.23808 7.69587V16.7152L5.5218 15.3571C5.04151 15.117 4.73813 14.6261 4.73813 14.0891V8.18408C4.73813 7.05179 6.00006 6.37643 6.94217 7.00451L7.34235 7.27129ZM12.8424 3.72863C13.9903 2.9633 15.4859 2.9633 16.6339 3.72863L19.7162 5.78352C20.667 6.41738 21.2381 7.48448 21.2381 8.62719V13.8158C21.2381 16.5455 18.1959 18.1737 15.9247 16.6595L15.5245 16.3927C15.0483 16.0753 14.4279 16.0753 13.9517 16.3927L10.9602 18.3871C9.93975 19.0674 8.63298 19.1488 7.53601 18.6003L4.62737 17.1459C3.46952 16.567 2.73813 15.3836 2.73813 14.0891V8.18408C2.73813 5.45441 5.78035 3.82625 8.05157 5.34041L8.45175 5.60719C8.92794 5.92465 9.54832 5.92465 10.0245 5.60719L12.8424 3.72863Z" fill="#363535"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Nơi làm việc</div>
                                            <div class="item-value">
                                                {{ checkValue($data->branch, 'name', 'Nhiều địa điểm làm việc tại HCM') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3964 4.49617C10.742 4.19377 11.258 4.19377 11.6036 4.49617L17.1036 9.30867C17.3026 9.48274 17.4167 9.7342 17.4167 9.99853V17.4166C17.4167 17.9229 17.0063 18.3333 16.5 18.3333H5.5C4.99374 18.3333 4.58333 17.9229 4.58333 17.4166V9.99853C4.58333 9.7342 4.69744 9.48274 4.89637 9.30867L10.3964 4.49617ZM12.8109 3.11645C11.7741 2.20923 10.2259 2.20923 9.18911 3.11645L3.68911 7.92895C3.09232 8.45114 2.75 9.20554 2.75 9.99853V17.4166C2.75 18.9354 3.98122 20.1666 5.5 20.1666H16.5C18.0188 20.1666 19.25 18.9354 19.25 17.4166V9.99853C19.25 9.20554 18.9077 8.45114 18.3109 7.92895L12.8109 3.11645ZM7.33333 14.6666C6.82707 14.6666 6.41667 15.077 6.41667 15.5833C6.41667 16.0896 6.82707 16.5 7.33333 16.5H14.6667C15.1729 16.5 15.5833 16.0896 15.5833 15.5833C15.5833 15.077 15.1729 14.6666 14.6667 14.6666H7.33333Z" fill="#363535"/>
                                              </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Hình thức</div>
                                            <div class="item-value">{{ checkValue($data->form, 'name') }}</div>
                                        </div>     
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.3225 4.66684C6.78553 4.66684 6.29464 4.97022 6.0545 5.45051L5.61302 6.33347H10.3282V4.66684H7.3225ZM12.3282 4.66684V6.33347H17.0436L16.6021 5.45051C16.362 4.97022 15.8711 4.66684 15.3341 4.66684H12.3282ZM4.99497 15.9158V8.33347H17.6616V15.9158C17.6616 16.6988 17.0269 17.3335 16.244 17.3335H6.41263C5.62968 17.3335 4.99497 16.6988 4.99497 15.9158ZM4.26565 4.55608C4.84457 3.39823 6.02798 2.66684 7.3225 2.66684H15.3341C16.6286 2.66684 17.812 3.39823 18.391 4.55608L19.3008 6.37581C19.5381 6.85038 19.6616 7.37366 19.6616 7.90424V15.9158C19.6616 17.8034 18.1315 19.3335 16.244 19.3335H6.41263C4.52511 19.3335 2.99497 17.8034 2.99497 15.9158V7.90424C2.99497 7.37366 3.1185 6.85038 3.35578 6.37581L4.26565 4.55608Z" fill="#363535"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Kinh nghiệm</div>
                                            <div class="item-value">{{ checkValue($data->experience, 'name') }}</div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path d="M6.1582 6.08417V16.0744C6.1582 17.0399 7.23424 17.6158 8.03757 17.0803L10.9877 15.1135C11.3937 14.8428 11.9227 14.8428 12.3287 15.1135L15.2788 17.0803C16.0822 17.6158 17.1582 17.0399 17.1582 16.0744V6.08417C17.1582 4.74893 16.0758 3.6665 14.7405 3.6665H8.57587C7.24063 3.6665 6.1582 4.74893 6.1582 6.08417Z" stroke="#363535" stroke-width="2.41766"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Cấp bậc</div>
                                            <div class="item-value">{{ checkValue($data->level, 'name') }}</div>
                                        </div>  
                                    </div>
                                    <div class="item">
                                        <div class="item-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2387 6.41684C10.2387 5.45034 11.0222 4.66684 11.9887 4.66684C12.9552 4.66684 13.7387 5.45034 13.7387 6.41684C13.7387 7.38334 12.9552 8.16684 11.9887 8.16684C11.0222 8.16684 10.2387 7.38334 10.2387 6.41684ZM11.9887 2.66684C9.91768 2.66684 8.23875 4.34577 8.23875 6.41684C8.23875 8.48791 9.91768 10.1668 11.9887 10.1668C14.0598 10.1668 15.7387 8.48791 15.7387 6.41684C15.7387 4.34577 14.0598 2.66684 11.9887 2.66684ZM17.351 17.3334H6.62659C6.99124 14.8352 9.14258 12.9168 11.742 12.9168H12.2356C14.835 12.9168 16.9863 14.8352 17.351 17.3334ZM11.742 10.9168C7.78217 10.9168 4.57211 14.1268 4.57211 18.0866C4.57211 18.7752 5.13032 19.3334 5.81891 19.3334H18.1587C18.8472 19.3334 19.4054 18.7752 19.4054 18.0866C19.4054 14.1268 16.1954 10.9168 12.2356 10.9168H11.742Z" fill="#363535"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="item-name">Số lượng</div>
                                            <div class="item-value">{{ checkValue($data, 'quantity') }}</div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="job-detail-component">
                    <div class="job-detail-content">
                        {!! checkValue($data, 'content') !!}
                    </div>
                    <div class="job-detail-related">
                        <div class="contact-block">
                            <div>
                                Kết nối với chúng tôi
                            </div>
                            <div>
                                <div class="job-detail-social-icons">
                                    <a href="{{ checkValue($arrSetups, 'facebook_link', '#') }}">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <a href="{{ checkValue($arrSetups, 'linkedin_link', '#') }}">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="job-related-block">
                            <div class="job-related-block-title">
                                Công việc liên quan
                            </div>
                            @if (isset($relatedCareers))
                                @foreach ($relatedCareers->slice(0, 5) as $relatedCareer)
                                    <a href="{{ route('career.detail', ['slug' => $relatedCareer->slug]) }}"
                                        class="job-related">
                                        <div class="job-related-name">
                                            {{ checkValue($relatedCareer, 'job_position') }}
                                        </div>
                                        <div class="job-related-branch">
                                            {{ checkValue($relatedCareer, 'branch_name') }}
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                            <div class="">
                                <a href="{{ route('page.slug', ['danh-sach-viec-lam']) }}"
                                    class="btn-submit btn-view-all-jobs" role="button" aria-pressed="true">Xem tất cả công
                                    việc</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- ======= Job Detail ======= -->

    <!-- ======= Recuitment Section ======= -->
    <section id="recuitment-process">
        <div class="container">
            <div class="recuitment-title">
                {!! checkValue($arrSetups, 'recuitment_process_title', 'Quy trình tuyển dụng 1') !!}
            </div>
            <div class="recuitment-process-img">
                <img src="{{ checkValue($arrSetups, 'recuitment_process_avatar', asset('/assets/imgs/recuitment-process.png')) }}"
                    alt="">
            </div>
        </div>
    </section>
    <!-- ======= End Recuitment Section ======= -->

    <!-- ======= End Contact Support Section ======= -->
    <section id="contact-support">
        <div class="container">
            <div class="row contact-support-block">
                <div class="col-xl-6 col-md-12">
                    <div class="contact-form-title-block">
                        <div class="contact-form-title">Bạn cần thêm hỗ trợ?</div>
                        <div class="contact-form-second-title">Hãy để lại lời nhắn cho Sunny Days Piano, Đội ngũ nhân viên
                            luôn tận tâm hỗ trợ bạn!</div>
                    </div>
                    <div class="job-detail-social-icons">
                        <a href="{{ checkValue($arrSetups, 'facebook_link', '#') }}">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="{{ checkValue($arrSetups, 'linkedin_link', '#') }}">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <form id="form-form" method="POST" action="{{ route('contact-support.store') }}">
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <div class="form-group-support">
                            <label class="text-form" for="full_name">Họ Tên</label>
                            <input type="text" class="form-control-support" id="full_name" name="full_name"
                                placeholder="Họ tên">
                        </div>
                        <div class="form-group-support">
                            <label class="text-form" for="phone">Số điện thoại</label>
                            <input type="text" class="form-control-support" id="phone" name="phone"
                                placeholder="Số điện thoại">
                        </div>
                        <div class="form-group-support">
                            <label class="text-form" for="note">Lời nhắn</label>
                            <textarea class="form-control-support" rows="5" id="note" name="note"></textarea>
                        </div>
                        <button type="submit" id="button-submit">
                            Gửi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Contact Support Section ======= -->

@endSection

@section('js')
@endSection

@push('js')
    <script>
        function contactFrom() {
            var _idContactForm = $('#form-form');

            $(_idContactForm).validate({
                rules: {
                    full_name: {
                        required: true,
                        maxlength: 255,
                        minlength: 5
                    },
                    phone: {
                        required: true,
                        maxlength: 11,
                        minlength: 10
                    },
                    note: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    full_name: {
                        required: "Vui lòng nhập thông tin họ và tên",
                        maxlength: "Trường họ tên không quá 255 ký tự",
                        minlength: "Trường họ tên phải có ít nhất 5 ký tự",
                    },
                    phone: {
                        required: "Vui lòng nhập thông tin số điện thoại",
                        maxlength: "Trường số điện thoại không vượt quá 11 ký tự",
                        minlength: "Trường số điện thoại không ít hơn 10 ký tự"
                    },
                    note: {
                        required: "Vui lòng nhập thông tin lời nhắn",
                        minlength: "Trường lời nhắn không ít hơn 10 ký tự"
                    }
                },

                submitHandler: function(form) {
                    var _htmlTemplate = $('#teamplate-backdrop-loading').html();

                    $('#backdrop-loading').html(_htmlTemplate);
                    grecaptcha.ready(function() {
                        var _reCaptChaKeySite = $('meta[name="reCapCha-site-key"]').attr('content');

                        grecaptcha.execute(_reCaptChaKeySite, {
                            action: 'submit'
                        }).then(function(token) {
                            $('#g-recaptcha-response').val(token);
                            console.log(token);
                            $('#button-submit').css("pointer-events", "none");
                            submitContactSupportFormWithAjax(form);
                        });
                    });
                }
            });
        }

        function submitContactSupportFormWithAjax(form) {
            $('#back-drop').show();
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                success: function(data) {
                    console.log('Form submitted successfully');
                    $('#back-drop').hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Đăng ký thành công!',
                        text: 'Thông tin của bạn đã gửi thành công.',
                        confirmButtonColor: '#ff8b00',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#form-form').each(function() {
                                this.reset();
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    $('#back-drop').hide();
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $('.error-message').hide();
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                $('#error-' + key).text(errors[key][0]).show();
                            }
                        }

                        var errors = xhr.responseJSON.errors;
                        var errorKeys = Object.keys(errors);
                        var errorsString = errorKeys.map(function(key) {
                            $('#error-' + key).text(errors[key][0]).show();
                            return key.toUpperCase() + ": " + errors[key][0];
                        }).join('\n');

                        Swal.fire({
                            icon: 'error',
                            title: 'Đăng ký không thành công',
                            text: 'Thông tin của bạn đã gửi không hợp lệ: \n' + errorsString
                        });
                    }
                }
            });
        }

        function detectApply() {
            $('.btn-apply-expired').on('click', function(e) {
                e.preventDefault();
            });
        }
        $(function() {
            detectApply();
            contactFrom();
        });
    </script>
@endpush

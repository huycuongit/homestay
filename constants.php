<?php

use Carbon\Carbon;

define('DAYONE_PASSWORD_DEFAULT', 'Dayone@123');


define('OLD_ACCOUNT', 0);
define('NEW_ACCOUNT', 1);

define('MALE', 0);
define('FEMALE', 1);
define('GENDER_OTHER', 2);

define('ACTIVE', 1);
define('INACTIVE', 0);

define('TEXT_ALL', 'Tất cả');
define('UPDATING', 'Đang cập nhật ...');

// NOTI
define('NOTIFICATION_CREATED_SUCCESS', 'Lưu thành công.');
define('NOTIFICATION_UPDATED_SUCCESS', 'Cập nhật thành công.');
define('NOTIFICATION_DELETED_SUCCESS', 'Xóa thành công.');
define('NOTIFICATION_CREATE_ERROR', 'Lưu không thành công.');
define('NOTIFICATION_UPDATED_ERROR', 'Cập nhật không thành công.');
define('NOTIFICATION_DELETED_ERROR', 'Xóa không thành công.');
define('NOTIFICATION_COMMAND_SUCCESS', 'Tạo mới thành công tất cả QR.');
define('NOTIFICATION_GET_DATA_SUCCESS', 'Lấy dữ liệu thành công.');
define('NOTIFICATION_GET_DATA_FAIL', 'Lấy dữ liệu không thành công.');

// STUDENT STATUS ACCOUNT
define('STATUS_ACCOUNT_NOT_ACTIVATED', 0);
define('STATUS_ACCOUNT_NOT_STARTED', 1);
define('STATUS_ACCOUNT_IN_TRAINING', 2);
define('STATUS_ACCOUNT_EXPIRED', 3);
define('STATUS_ACCOUNT_SUSPENDED', 4);

define('STATUS_ACCOUNT_NOT_ACTIVATED_TEXT', 'Chưa kích hoạt');
define('STATUS_ACCOUNT_NOT_STARTED_TEXT', 'Chưa bắt đầu');
define('STATUS_ACCOUNT_IN_TRAINING_TEXT', 'Đang tập');
define('STATUS_ACCOUNT_EXPIRED_TEXT', 'Hết hạn tập');
define('STATUS_ACCOUNT_SUSPENDED_TEXT', 'Đang bảo lưu');
define('STATUS_ACCOUNT_EXPIRING_SOON_TEXT', 'Sắp hết hạn');

// CONTRACT
define('STATUS_CONTRACT_NOT_STARTED', 0);
define('STATUS_CONTRACT_IN_TRAINING', 2);
define('STATUS_CONTRACT_SUSPENDED', 4);

define('STATUS_CONTRACT_IN_TRAINING_TEXT', 'Còn hạn');
define('STATUS_CONTRACT_NOT_STARTED_TEXT', 'Chưa kích hoạt');
define('STATUS_CONTRACT_EXPIRING_SOON_TEXT', 'Sắp hết hạn');
define('STATUS_CONTRACT_SUSPENDED_TEXT', 'Bảo lưu');


// INSTRUMENT - TYPE
define('INSTRUMENT_GOOD', 1);
define('INSTRUMENT_BROKEN', 2);
define('INSTRUMENT_HARD', 3);
define('INSTRUMENT_TRANSFERRED', 4);

// COACH
define('COACH_CT1', 'CT1');
define('COACH_CT2', 'CT2');
define('COACH_TRIAL', 'TRIAL');
define('COACH_ONE_ONE', 'ONE');

// CLASS - TYPE
define('CLASSES', 'CLASS');
define('ONE_GENERAL', 'ONE_GENERAL');
define('ONE_PRIVATE', 'ONE_PRIVATE');
define('CLASS_PRACTICE', 'CLASS_PRACTICE');
define('P1P2', 'P1P2');
define('TRIAL', 'TRIAL');

// SHAREHOLDER - TYPE
define('SHAREHOLDER_TYPE_CLASS', 'CLASS');
define('SHAREHOLDER_TYPE_PRACTICE', 'PRACTICE');

define('SHAREHOLDER_ORDER', 1);
define('SHAREHOLDER_CANCELED', 0);

// SHAREHOLDER - Status SHAREHOLDER type CLASS
define('STATUS_OCCURRED', 0);
define('STATUS_PLANNED', 1);
define('STATUS_IN_PROGRESS', 2);

// SHAREHOLDER - Status SHAREHOLDER type PRACTICE
define('PRACTICE_COMPLETED', 1);
define('PRACTICE_NOT_STARTED', 2);
define('PRACTICING', 3);
define('PRACTICE_NOT_DONE', 4);

// SHAREHOLDER - Status in class
define('SHAREHOLDER_NOT_YET_CLASS', 1);
define('SHAREHOLDER_IN_CLASS', 2);
define('SHAREHOLDER_NOT_GOING_CLASS', 3);

// SHAREHOLDER - Burn show status
define('SHAREHOLDER_NOT_YET_BURN_SHOW', 0);
define('SHAREHOLDER_BURN_SHOW', 2);
define('SHAREHOLDER_NOT_BURN_SHOW', 1);

// Student
define('RESET_CANCEL_TRUE', 1);
define('RESET_CANCEL_FALSE', 0);

// LOG - Type SHAREHOLDER log
define('SHAREHOLDER_LOG_ORDER', 1);
define('SHAREHOLDER_LOG_CANCELED', 2);
define('SHAREHOLDER_LOG_BURN_SHOW', 5);
define('SHAREHOLDER_LOG_CONFIRM_IN_CLASS', 3);
define('SHAREHOLDER_LOG_CONFIRM_NOT_YET_CLASS', 4);

// PRODUCT - Package
define('MONTHLY_PACKAGE', 1);
define('SESSION_PACKAGE', 2);

define('ONE_BRANCH', 1);
define('ALL_BRANCHES', 2);

// PROMOTION

// define('PROMOTION_MONTH', 0);
// define('PROMOTION_SESSION', 1);
// define('PROMOTION_voucher', 2);
// define('PROMOTION_OTHER', 3);

// WEEKDAYS
define('MONDAY', 1);
define('TUESDAY', 2);
define('WEDNESDAY', 3);
define('THURSDAY', 4);
define('FRIDAY', 5);
define('SATURDAY', 6);
define('SUNDAY', 0);

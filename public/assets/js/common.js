var baseUrl = jQuery('#base_url').val();

/************ Video ************/
var datafile = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight,html4',
    browse_button: 'uploadFile', // you can pass in id...
    container: document.getElementById('container'), // ... or DOM Element itself
    chunk_size: '1mb',
    url: baseUrl + '/admin/video/saveChunk',
    max_file_count: 1,
    unique_names: true,
    send_file_name: true,
    multi_selection: false,
    filters: {
        mime_types: [
            { title: "Content files", extensions: "mp4" },
        ],
        prevent_duplicates: true
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init: {
        PostInit: function () {
            document.getElementById('filelist').innerHTML = '';
            document.getElementById('upload').onclick = function () {
                datafile.start();
                return false;
            };
        },
        FilesAdded: function (up, files) {

            while (up.files.length > 1) {
                up.removeFile(up.files[0]);
                document.getElementById('filelist').innerHTML = '';
            }

            plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            if (file.percent > 60) {
                // jQuery('#mp3_file_name').val(file.name);
            }
        },
        FileUploaded: function (up, file) {
            jQuery('#mp3_file_name').val(file.target_name);
        },
        Error: function (up, err) {
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
datafile.init();

/************ Tutor Video ************/
var datafile1 = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight,html4',
    browse_button: 'uploadFile1', // you can pass in id...
    container: document.getElementById('container1'), // ... or DOM Element itself
    chunk_size: '1mb',
    url: baseUrl + '/tutor/tvideo/saveChunk',
    max_file_count: 1,
    unique_names: true,
    send_file_name: true,
    multi_selection: false,
    filters: {
        mime_types: [
            { title: "Content files", extensions: "mp4" },
        ],
        prevent_duplicates: true
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init: {
        PostInit: function () {
            document.getElementById('filelist1').innerHTML = '';
            document.getElementById('upload1').onclick = function () {
                datafile1.start();
                return false;
            };
        },
        FilesAdded: function (up, files) {

            while (up.files.length > 1) {
                up.removeFile(up.files[0]);
                document.getElementById('filelist1').innerHTML = '';
            }

            plupload.each(files, function (file) {
                document.getElementById('filelist1').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            if (file.percent > 60) {
                // jQuery('#mp3_file_name1').val(file.name);
            }
        },
        FileUploaded: function (up, file) {
            jQuery('#mp3_file_name1').val(file.target_name);
        },
        Error: function (up, err) {
            document.getElementById('console1').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
datafile1.init();

var datafile2 = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight,html4',
    browse_button: 'uploadFile2', // you can pass in id...
    container: document.getElementById('container2'), // ... or DOM Element itself
    chunk_size: '1mb',
    url: baseUrl + '/admin/book/savechunk',
    max_file_count: 1,
    unique_names: true,
    send_file_name: true,
    multi_selection: false,
    filters: {
        mime_types: [
            { title: "Content files", extensions: "pdf" },
        ],
        prevent_duplicates: true
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init: {
        PostInit: function () {
            document.getElementById('filelist2').innerHTML = '';
            document.getElementById('upload2').onclick = function () {
                datafile2.start();
                return false;
            };
        },
        FilesAdded: function (up, files) {

            while (up.files.length > 1) {
                up.removeFile(up.files[0]);
                document.getElementById('filelist2').innerHTML = '';
            }

            plupload.each(files, function (file) {
                document.getElementById('filelist2').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            if (file.percent > 60) {
            }
        },
        FileUploaded: function (up, file) {
            jQuery('#pdf_file_name').val(file.target_name);
        },
        Error: function (up, err) {
            document.getElementById('console2').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
datafile2.init();

var datafile3 = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight,html4',
    browse_button: 'uploadFile3', // you can pass in id...
    container: document.getElementById('container3'), // ... or DOM Element itself
    chunk_size: '1mb',
    url: baseUrl + '/tutor/tbook/savechunk',
    max_file_count: 1,
    unique_names: true,
    send_file_name: true,
    multi_selection: false,
    filters: {
        mime_types: [
            { title: "Content files", extensions: "pdf" },
        ],
        prevent_duplicates: true
    },
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init: {
        PostInit: function () {
            document.getElementById('filelist3').innerHTML = '';
            document.getElementById('upload3').onclick = function () {
                datafile3.start();
                return false;
            };
        },
        FilesAdded: function (up, files) {

            while (up.files.length > 1) {
                up.removeFile(up.files[0]);
                document.getElementById('filelist3').innerHTML = '';
            }

            plupload.each(files, function (file) {
                document.getElementById('filelist3').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            if (file.percent > 60) {
            }
        },
        FileUploaded: function (up, file) {
            jQuery('#pdf_file_name1').val(file.target_name);
        },
        Error: function (up, err) {
            document.getElementById('console3').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});
datafile3.init();

// Tutor Book Pdf Upload


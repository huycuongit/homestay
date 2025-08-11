<h3>SEO</h3>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group form-float mb-6">
            <div class="font-bold col-green">Tiêu Đề</div>
            <div class="form-line">
                <input type="text" class="form-control" name="meta_data[title]"
                    value="{{ old("meta_data[title]", !empty($metaData) ? $metaData->title : "") }}">
            </div>
        </div>

        <div class="form-group form-float mb-6">
            <div class="font-bold col-green">Mô tả</div>
            <div class="form-line">
            <textarea 
                rows="3" 
                class="form-control no-resize"
                name="meta_data[description]">{{ old("meta_data[description]", !empty($metaData) ? $metaData->description : "") }}</textarea>
            </div>
        </div>

        <div class="form-group form-float mb-6">
            <div class="font-bold col-green">Keyword (nếu cần)</div>
            <div class="form-line">
            <textarea 
                rows="3" 
                class="form-control no-resize"
                name="meta_data[key_words]">{{ old("meta_data[key_words]", !empty($metaData) ? $metaData->key_words : "") }}</textarea>
            </div>
        </div>
    </div>
</div>
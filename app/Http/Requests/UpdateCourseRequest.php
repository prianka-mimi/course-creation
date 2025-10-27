<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'                                   => 'required|string|max:255',
            'description'                             => 'nullable|string',
            'category'                                => 'required',
            'feature_video'                           => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400', // 100MB max
            'status'                                  => 'nullable|in:' . implode(',', array_keys(Course::STATUS_LIST)),
            'modules'                                 => 'nullable|array',
            'modules.*.title'                         => 'required|string|max:255',
            'modules.*.contents'                      => 'nullable|array',
            'modules.*.contents.*.title'              => 'required|string|max:255',
            'modules.*.contents.*.type'               => 'required|string|in:text,image,video,link',
            'modules.*.contents.*.content_text'       => 'nullable|string',
            'modules.*.contents.*.image_path'         => 'nullable|file|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max
            'modules.*.contents.*.link_url'           => 'nullable|url',
            'modules.*.contents.*.video_source_type'  => 'nullable|string',
            'modules.*.contents.*.video_url'          => 'nullable|url',
            'modules.*.contents.*.video_length'       => 'nullable|string|regex:/^\d{2}:\d{2}:\d{2}$/',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title'                                   => 'course title',
            'description'                             => 'course description',
            'category'                                => 'course category',
            'feature_video'                           => 'featured video',
            'status'                                  => 'course status',
            'modules.*.title'                         => 'module title',
            'modules.*.contents.*.title'              => 'content title',
            'modules.*.contents.*.type'               => 'content type',
            'modules.*.contents.*.content_text'       => 'content text',
            'modules.*.contents.*.image_path'         => 'image',
            'modules.*.contents.*.link_url'           => 'link URL',
            'modules.*.contents.*.video_source_type'  => 'video source type',
            'modules.*.contents.*.video_url'          => 'video URL',
            'modules.*.contents.*.video_length'       => 'video length',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'                          => 'Please provide a title for the course.',
            'category.required'                       => 'Please select at least one category for the course.',
            'modules.*.title.required'                => 'Each module must have a title.',
            'modules.*.contents.*.title.required'     => 'Each content item must have a title.',
            'modules.*.contents.*.type.required'      => 'Please select a type for each content item.',
            'modules.*.contents.*.type.in'            => 'The content type must be one of: text, image, video, or link.',
            'feature_video.mimes'                     => 'The featured video must be a valid video file (MP4, MOV, AVI, WMV).',
            'feature_video.max'                       => 'The featured video must not exceed 100MB in size.',
            'modules.*.contents.*.image_path.mimes'   => 'The image must be a valid image file (JPEG, JPG, PNG, GIF).',
            'modules.*.contents.*.image_path.max'     => 'The image must not exceed 5MB in size.',
            'modules.*.contents.*.link_url.url'       => 'Please provide a valid URL for the link.',
            'modules.*.contents.*.video_url.url'      => 'Please provide a valid URL for the video.',
            'modules.*.contents.*.video_length.regex' => 'The video length must be in HH:MM:SS format (e.g., 00:05:30).',
        ];
    }
}

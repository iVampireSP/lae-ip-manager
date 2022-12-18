<?php

declare(strict_types=1);

return [
    'accepted'             => '您必须接受 :attribute。',
    'accepted_if'          => '当 :other 为 :value 时，必须接受 :attribute。',
    'active_url'           => ':Attribute 不是一个有效的网址。',
    'after'                => ':Attribute 必须要晚于 :date。',
    'after_or_equal'       => ':Attribute 必须要等于 :date 或更晚。',
    'alpha'                => ':Attribute 只能由字母组成。',
    'alpha_dash'           => ':Attribute 只能由字母、数字、短划线(-)和下划线(_)组成。',
    'alpha_num'            => ':Attribute 只能由字母和数字组成。',
    'array'                => ':Attribute 必须是一个数组。',
    'ascii'                => 'The :attribute must only contain single-byte alphanumeric characters and symbols.',
    'before'               => ':Attribute 必须要早于 :date。',
    'before_or_equal'      => ':Attribute 必须要等于 :date 或更早。',
    'between'              => [
        'array'   => ':Attribute 必须只有 :min - :max 个单元。',
        'file'    => ':Attribute 必须介于 :min - :max KB 之间。',
        'numeric' => ':Attribute 必须介于 :min - :max 之间。',
        'string'  => ':Attribute 必须介于 :min - :max 个字符之间。',
    ],
    'boolean'              => ':Attribute 必须为布尔值。',
    'confirmed'            => ':Attribute 两次输入不一致。',
    'current_password'     => '密码错误。',
    'date'                 => ':Attribute 不是一个有效的日期。',
    'date_equals'          => ':Attribute 必须要等于 :date。',
    'date_format'          => ':Attribute 的格式必须为 :format。',
    'declined'             => ':Attribute 必须是拒绝的。',
    'declined_if'          => '当 :other 为 :value 时字段 :attribute 必须是拒绝的。',
    'different'            => ':Attribute 和 :other 必须不同。',
    'digits'               => ':Attribute 必须是 :digits 位数字。',
    'digits_between'       => ':Attribute 必须是介于 :min 和 :max 位的数字。',
    'dimensions'           => ':Attribute 图片尺寸不正确。',
    'distinct'             => ':Attribute 已经存在。',
    'doesnt_end_with'      => ':Attribute 不能以以下之一结尾: :values。',
    'doesnt_start_with'    => ':Attribute 不能以下列之一开头: :values。',
    'email'                => ':Attribute 不是一个合法的邮箱。',
    'ends_with'            => ':Attribute 必须以 :values 为结尾。',
    'enum'                 => ':Attribute 值不正确。',
    'exists'               => ':Attribute 不存在。',
    'file'                 => ':Attribute 必须是文件。',
    'filled'               => ':Attribute 不能为空。',
    'gt'                   => [
        'array'   => ':Attribute 必须多于 :value 个元素。',
        'file'    => ':Attribute 必须大于 :value KB。',
        'numeric' => ':Attribute 必须大于 :value。',
        'string'  => ':Attribute 必须多于 :value 个字符。',
    ],
    'gte'                  => [
        'array'   => ':Attribute 必须多于或等于 :value 个元素。',
        'file'    => ':Attribute 必须大于或等于 :value KB。',
        'numeric' => ':Attribute 必须大于或等于 :value。',
        'string'  => ':Attribute 必须多于或等于 :value 个字符。',
    ],
    'image'                => ':Attribute 必须是图片。',
    'in'                   => '已选的属性 :attribute 无效。',
    'in_array'             => ':Attribute 必须在 :other 中。',
    'integer'              => ':Attribute 必须是整数。',
    'ip'                   => ':Attribute 必须是有效的 IP 地址。',
    'ipv4'                 => ':Attribute 必须是有效的 IPv4 地址。',
    'ipv6'                 => ':Attribute 必须是有效的 IPv6 地址。',
    'json'                 => ':Attribute 必须是正确的 JSON 格式。',
    'lowercase'            => ':Attribute 必须小写。',
    'lt'                   => [
        'array'   => ':Attribute 必须少于 :value 个元素。',
        'file'    => ':Attribute 必须小于 :value KB。',
        'numeric' => ':Attribute 必须小于 :value。',
        'string'  => ':Attribute 必须少于 :value 个字符。',
    ],
    'lte'                  => [
        'array'   => ':Attribute 必须少于或等于 :value 个元素。',
        'file'    => ':Attribute 必须小于或等于 :value KB。',
        'numeric' => ':Attribute 必须小于或等于 :value。',
        'string'  => ':Attribute 必须少于或等于 :value 个字符。',
    ],
    'mac_address'          => ':Attribute 必须是一个有效的 MAC 地址。',
    'max'                  => [
        'array'   => ':Attribute 最多只有 :max 个单元。',
        'file'    => ':Attribute 不能大于 :max KB。',
        'numeric' => ':Attribute 不能大于 :max。',
        'string'  => ':Attribute 不能大于 :max 个字符。',
    ],
    'max_digits'           => ':Attribute 不能超过 :max 位数。',
    'mimes'                => ':Attribute 必须是一个 :values 类型的文件。',
    'mimetypes'            => ':Attribute 必须是一个 :values 类型的文件。',
    'min'                  => [
        'array'   => ':Attribute 至少有 :min 个单元。',
        'file'    => ':Attribute 大小不能小于 :min KB。',
        'numeric' => ':Attribute 必须大于等于 :min。',
        'string'  => ':Attribute 至少为 :min 个字符。',
    ],
    'min_digits'           => ':Attribute 必须至少有 :min 位数。',
    'multiple_of'          => ':Attribute 必须是 :value 中的多个值。',
    'not_in'               => '已选的属性 :attribute 非法。',
    'not_regex'            => ':Attribute 的格式错误。',
    'numeric'              => ':Attribute 必须是一个数字。',
    'password'             => [
        'letters'       => ':Attribute 必须至少包含一个字母。',
        'mixed'         => ':Attribute 必须至少包含一个大写字母和一个小写字母。',
        'numbers'       => ':Attribute 必须至少包含一个数字。',
        'symbols'       => ':Attribute 必须至少包含一个符号。',
        'uncompromised' => '给定的 :attribute 出现在数据泄漏中。请选择不同的 :attribute。',
    ],
    'present'              => ':Attribute 必须存在。',
    'prohibited'           => ':Attribute 字段被禁止。',
    'prohibited_if'        => '当 :other 为 :value 时，禁止 :attribute 字段。',
    'prohibited_unless'    => ':Attribute 字段被禁止，除非 :other 位于 :values 中。',
    'prohibits'            => ':Attribute 字段禁止出现 :other。',
    'regex'                => ':Attribute 格式不正确。',
    'required'             => ':Attribute 不能为空。',
    'required_array_keys'  => ':Attribute 至少包含指定的键：:values.',
    'required_if'          => '当 :other 为 :value 时 :attribute 不能为空。',
    'required_if_accepted' => '当 :other 存在时，:attribute 不能为空。',
    'required_unless'      => '当 :other 不为 :values 时 :attribute 不能为空。',
    'required_with'        => '当 :values 存在时 :attribute 不能为空。',
    'required_with_all'    => '当 :values 存在时 :attribute 不能为空。',
    'required_without'     => '当 :values 不存在时 :attribute 不能为空。',
    'required_without_all' => '当 :values 都不存在时 :attribute 不能为空。',
    'same'                 => ':Attribute 和 :other 必须相同。',
    'size'                 => [
        'array'   => ':Attribute 必须为 :size 个单元。',
        'file'    => ':Attribute 大小必须为 :size KB。',
        'numeric' => ':Attribute 大小必须为 :size。',
        'string'  => ':Attribute 必须是 :size 个字符。',
    ],
    'starts_with'          => ':Attribute 必须以 :values 为开头。',
    'string'               => ':Attribute 必须是一个字符串。',
    'timezone'             => ':Attribute 必须是一个合法的时区值。',
    'ulid'                 => 'The :attribute must be a valid ULID.',
    'unique'               => ':Attribute 已经存在。',
    'uploaded'             => ':Attribute 上传失败。',
    'uppercase'            => ':Attribute 必须大写',
    'url'                  => ':Attribute 格式不正确。',
    'uuid'                 => ':Attribute 必须是有效的 UUID。',
    'attributes'           => [
        'address'                  => '地址',
        'age'                      => '年龄',
        'amount'                   => '数额',
        'area'                     => '区域',
        'available'                => '可用的',
        'birthday'                 => '生日',
        'body'                     => '身体',
        'city'                     => '城市',
        'content'                  => '内容',
        'country'                  => '国家',
        'created_at'               => '创建于',
        'creator'                  => '创建者',
        'current_password'         => '当前密码',
        'date'                     => '日期',
        'date_of_birth'            => '出生日期',
        'day'                      => '天',
        'deleted_at'               => '删除于',
        'description'              => '描述',
        'district'                 => '地区',
        'duration'                 => '期间',
        'email'                    => '邮箱',
        'excerpt'                  => '摘要',
        'filter'                   => '过滤',
        'first_name'               => '名',
        'gender'                   => '性别',
        'group'                    => '组',
        'hour'                     => '时',
        'image'                    => '图像',
        'last_name'                => '姓',
        'lesson'                   => '课程',
        'line_address_1'           => '线路地址 1',
        'line_address_2'           => '线路地址 2',
        'message'                  => '信息',
        'middle_name'              => '中间名字',
        'minute'                   => '分',
        'mobile'                   => '手机',
        'month'                    => '月',
        'name'                     => '名称',
        'national_code'            => '国家代码',
        'number'                   => '数字',
        'password'                 => '密码',
        'password_confirmation'    => '确认密码',
        'phone'                    => '电话',
        'photo'                    => '照片',
        'postal_code'              => '邮政编码',
        'price'                    => '价格',
        'province'                 => '省',
        'recaptcha_response_field' => '重复验证码响应字段',
        'remember'                 => '记住',
        'restored_at'              => '恢复于',
        'result_text_under_image'  => '图像下的结果文本',
        'role'                     => '角色',
        'second'                   => '秒',
        'sex'                      => '性别',
        'short_text'               => '短文本',
        'size'                     => '大小',
        'state'                    => '状态',
        'street'                   => '街道',
        'student'                  => '学生',
        'subject'                  => '主题',
        'teacher'                  => '教师',
        'terms'                    => '条款',
        'test_description'         => '测试说明',
        'test_locale'              => '测试语言环境',
        'test_name'                => '测试名称',
        'text'                     => '文本',
        'time'                     => '时间',
        'title'                    => '标题',
        'updated_at'               => '更新于',
        'username'                 => '用户名',
        'year'                     => '年',
    ],
];

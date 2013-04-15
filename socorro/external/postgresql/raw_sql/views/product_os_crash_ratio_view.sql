CREATE VIEW product_os_crash_ratio AS
    SELECT crcounts.product_version_id, product_versions.product_name, product_versions.version_string, os_names.os_short_name, os_names.os_name, crcounts.report_date AS adu_date, (sum(crcounts.report_count))::bigint AS crashes, sum(crcounts.adu) AS adu_count, (product_release_channels.throttle)::numeric(5,2) AS throttle, (sum(((crcounts.report_count)::numeric / product_release_channels.throttle)))::integer AS adjusted_crashes, crash_hadu((sum(crcounts.report_count))::bigint, sum(crcounts.adu), product_release_channels.throttle) AS crash_ratio FROM (((crashes_by_user_rollup crcounts JOIN product_versions ON ((crcounts.product_version_id = product_versions.product_version_id))) JOIN os_names ON ((crcounts.os_short_name = os_names.os_short_name))) JOIN product_release_channels ON (((product_versions.product_name = product_release_channels.product_name) AND (product_versions.build_type = product_release_channels.release_channel)))) GROUP BY crcounts.product_version_id, product_versions.product_name, product_versions.version_string, os_names.os_name, os_names.os_short_name, crcounts.report_date, product_release_channels.throttle
;
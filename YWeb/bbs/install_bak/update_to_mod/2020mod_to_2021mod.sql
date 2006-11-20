INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars', '3');
DELETE FROM phpbb_sessions;
DELETE FROM phpbb_sessions_keys;
UPDATE phpbb_config SET config_value = '.0.21' WHERE config_name = 'version';
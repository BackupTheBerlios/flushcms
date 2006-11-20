ALTER TABLE phpbb_search_results ADD COLUMN search_time int(11) DEFAULT '0' NOT NULL;
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_flood_interval', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');
DELETE FROM phpbb_sessions;
DELETE FROM phpbb_sessions_keys;
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars', '3');
UPDATE phpbb_config SET config_value = '.0.21' WHERE config_name = 'version';
seed_users = """INSERT INTO users (
    name,
    email,
    password
) VALUES (
    'Test User',
    'test@example.com', 'ab77aa2315182a868c50a80d4f073ee8afe8f542a4b4d6218f220e40a6e541d405b42ae376b37c5d75eaf104bffbe7501e6dfb2f22f4452ff0a2e2b5ef5ca64087418860f81951060250a096eafad7dbca0ee11ad7d7194138e18a9e60e3afeb'
);"""

seed_packages = """INSERT INTO packages (
    id, name, price
) VALUES
    ('PKGDT001', 'DAY WORKOUT', 3000),
    ('PKGDT002', 'EXECUTIVE PACK', 5000),
    ('PKGDT003', 'MONTHLY', 4000);
"""

seed_supplements = """INSERT INTO supplements (
    id, name, price
) VALUES
    ('ITMST001', 'BEAST SUPER SAUNA', 3000),
    ('ITMST002', 'ON FISH OIL', 5000),
    ('ITMST003', 'CREATINE 5000', 4000);
"""

import { tidyUrl } from '@/Utils/helpers';

describe('Utilities Tests', () => {
    test('it tidies urls', () => {
        expect(tidyUrl('foo/bar')).toBe('foo/bar');
        expect(tidyUrl('foo//bar')).toBe('foo/bar');
        expect(tidyUrl('foo///bar')).toBe('foo/bar');
        expect(tidyUrl('foo////bar')).toBe('foo/bar');
        expect(tidyUrl('http://foo//bar')).toBe('http://foo/bar');
        expect(tidyUrl('https://foo//bar')).toBe('https://foo/bar');
        expect(tidyUrl('notaprotocol://foo//bar')).toBe('notaprotocol://foo/bar');
    });
});
